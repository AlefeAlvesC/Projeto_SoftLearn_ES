<?php

namespace App\Http\Controllers;

use App\Enums\CardState;
use App\Enums\ReviewStatus;
use App\Models\CardRecord;
use App\Models\Deck;
use App\Models\Review;
use DateInterval;
use DateTime;
use DateTimeZone;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ReviewController extends Controller
{
    static $W = [0.40255, 1.18385, 3.173, 15.69105, 7.1949, 0.5345, 1.4604, 0.0046, 1.54575, 0.1192, 1.01925, 1.9395, 0.11, 0.29605, 2.2698, 0.2315, 2.9898, 0.51655, 0.6621];

    public function index(Request $request, Deck $deck, string $review_id = null)
    {
        if ($deck->owner->id != Auth::id()) {
            abort(404);
        }

        $review = Review::find($review_id);

        if ($review != null && $review->review_time == null) {
            $card = $review->card;
            return view('decks.review', compact('deck', 'review', 'card'));
        }

        $review = $this->appointNextReview($deck);

        if ($review == null) {
            return to_route('deck.index');
        }
        return to_route('review.index', [ $deck->id, $review->id ]);
    }

    function appointNextReview(Deck $deck)
    {
        $now =  new DateTime('now', new DateTimeZone('UTC'));
        $review = $this->findNextReview($deck, $now);

        // no review found
        if ($review == null) {
            return null;
        }

        // review of new card
        if ($review->id == null) {
            $review->scheduled_time = $now->format(DateTime::ATOM);
            $review->save();
        }
        return $review;
    }

    /**
     * Search on database for reviews pending at given time. It returns a review
     * if a review is needed or null if no review is needed. The returned review
     * maybe an existing stored review or a new Review model if a deck card was
     * never reviewed before.
     */
    public function findNextReview(Deck $deck, DateTime $time) {
        $user_id = Auth::id();

        $review_data = DB::table('cards')
            ->join('deck_cards', 'deck_cards.card_id', '=', 'cards.id')
            ->join('decks', 'decks.id', '=', 'deck_cards.deck_id')
            ->leftJoin('reviews', 'reviews.card_id', '=', 'cards.id')
            ->where('decks.id', '=', $deck->id)
            ->where('cards.user_id', '=', $user_id)
            ->whereNull('reviews.review_time')
            ->where(function (Builder $query) use ($time) {
                $query->whereNull('reviews.id')
                    ->orWhere('reviews.scheduled_time', '<=', $time->format(DateTime::ATOM));
            })
            ->orderByDesc('reviews.scheduled_time')
            ->select(['reviews.*', 'cards.id as card_id'])
            ->first();

        if ($review_data == null) {
            return null;
        }

        $review = new Review();
        $review->fill(get_object_vars($review_data));

        return $review;
    }

    public function saveReview(Request $request, Deck $deck)
    {
        $request->validate([
            'review_id' => 'required|string',
            'status' => ['required', Rule::enum(ReviewStatus::class)]
        ]);

        $review = Review::with('previous', 'card')->findOrFail($request->get('review_id'));
        $user_id = Auth::id();

        if ($review->card->owner->id != $user_id) {
            abort(404);
        }

        if ($review->review_time != null) {
            return to_route('review.index', [ $deck->id ]);
        }

        $now = new DateTime('now', new DateTimeZone('UTC'));

        $review->status = $request->status;
        $review->review_time = $now->format(DateTime::ATOM);
        
        $this->updateRecord($review);
        $review->update();
        $review->refresh();

        $this->schedule($review);
        return to_route('review.index', [$deck->id]);
    }

    public function updateRecord(Review $review) {
        $record = $review->card->record;
        $new_record = $record == null;
        if ($new_record) {
            $record = $this->newRecord();
        }

        $interval = DateInterval::createFromDateString("0 days");
        $last_review = Review::find($review->previous);
        if ($last_review != null) {
            $interval = $review->interval($last_review->review_time);
        }

        $record->stability = $this->stability($interval, $review->status, $record);
        $record->difficulty = $this->difficulty($review->status, $record);
        
        $record->state = $this->nextState($record->state, $review->status);

        $record->save();

        if ($new_record) {
            $review->card->record()->save($record);
        }
    }

    public function newRecord(): CardRecord {
        $record = new CardRecord();
        $record->state = CardState::NEW;
        return $record;
    }

    public function schedule(Review $last_review) {
        $card = $last_review->card;
        $record = $card->record;

        $new_review = new Review();
        $new_time = clone $last_review->review_time;

        $interval = $this->nextInterval($record->stability, $record->state);

        $new_review->card()->associate($card);
        $new_review->scheduled_time = $new_time->add($interval)->format(DateTime::ATOM);
        $new_review->previous = $last_review->id;
        
        $new_review->save();
        $new_review->refresh();
        
        return $new_review;
    }

    function clamp(float $min, float $max, float $value) {
        if ($value < $min) {
            return $min;
        }

        if ($value > $max) {
            return $max;
        }
        return $value;
    }

    public function difficulty(ReviewStatus $status, CardRecord $record): float {
        if ($record->state == CardState::NEW) {
            return $this->initialDifficulty($status);
        }

        $D = $record->difficulty;

        $deltaD = -static::$W[6] * ($status->value - 3); 
        $D = $D + $deltaD * (10 - $D) / 9;

        $D = $this->meanRevision($D);

        return $this->clamp(1, 10, $D);
    }

    function initialDifficulty(ReviewStatus $status) {
        $d = static::$W[4] - exp(static::$W[5] * ($status->value - 1)) + 1;
        return $this->clamp(1, 10, $d);
    }

    function meanRevision(float $D) {
        $w7 = static::$W[7];
        $D4 = $this->initialDifficulty(ReviewStatus::EASY);

        return $w7 * $D4 + (1 - $w7) * $D;
    }

    public function stability(DateInterval $interval, ReviewStatus $status, CardRecord $record): float {
        if ($record->state == CardState::NEW) {
            $S = static::$W[$status->value - 1];
            return $S;
        }

        $state = $record->state;
        $stability = $record->stability;

        if ($state == CardState::NEW || $state == CardState::LEARNING || $interval->days == 0) {
            return $stability * exp(static::$W[17] * ($status->value - 3 + static::$W[18]));
        }

        $difficulty = $record->difficulty;
        $retrievability = $this->retrievability($interval->days, $record);

        if ($status == ReviewStatus::AGAIN) {
            return static::$W[11]
                * pow($difficulty, -static::$W[12])
                * (pow($stability + 1, static::$W[13]) - 1)
                * exp(static::$W[14] * (1 - $retrievability));
        }

        $hard_mod = $status === ReviewStatus::HARD->value? static::$W[15] : 1;
        $easy_mod = $status === ReviewStatus::EASY->value? static::$W[16] : 1;

        return $stability * (
            exp(static::$W[8])
            * (11 - $difficulty)
            * pow($stability, -static::$W[9])
            * (exp(static::$W[10] * (1 - $retrievability)) - 1)
            * $hard_mod
            * $easy_mod
            + 1
        );
    }

    public function retrievability(int $interval, $record) {
        $stability = $record->stability;

        $factor = 19/81;
        $decay = -0.5;

        return pow(1 + $factor * $interval / $stability, $decay); 
    }

    public function nextState(CardState $state, ReviewStatus $status): CardState {
        if ($state == CardState::NEW) {
            switch ($status) {
                case ReviewStatus::AGAIN:
                case ReviewStatus::HARD:
                case ReviewStatus::GOOD:
                    return CardState::LEARNING;

                case ReviewStatus::EASY:
                    return CardState::REVIEW;
            }
        }

        if ($state == CardState::LEARNING || $state == CardState::RELEARNING) {
            switch($status) {
                case ReviewStatus::AGAIN:
                case ReviewStatus::HARD:
                    return $state;
                
                case ReviewStatus::GOOD:
                case ReviewStatus::EASY:
                    return CardState::REVIEW;
            }
        }

        if ($status == ReviewStatus::AGAIN) {
            return CardState::RELEARNING;
        }
        return $state;
    }

    public function nextInterval(float $stability, CardState $state): DateInterval {
        if ($state == CardState::NEW) {
            $amount = floor($stability);
            return DateInterval::createFromDateString("$amount minutes");
        }

        if ($state == CardState::LEARNING) {
            $amount = 2 * $stability;
            $amount = floor($amount);
            return DateInterval::createFromDateString("$amount minutes");
        }

        $amount = floor($stability);
        return DateInterval::createFromDateString("$amount days");
    }
}
