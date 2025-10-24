<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/flashcards', function () {
        return view('flashcards'); 
    })->name('flashcards'); 

Route::get('/diagramas', function () {
    return view('diagramas'); 
})->name('diagramas');

Route::get('/calendario', function () {
    return view('calendario'); 
})->name('calendario');

Route::get('/revisoes', function () {
    return view('revisoes'); 
})->name('revisoes');

Route::get('/informacoes', function () {
    return view('informacoes'); 
})->name('informacoes');

Route::get('/configuracoes', function () {
    return view('configuracoes'); 
})->name('configuracoes');

Route::get('/meu-plano', function () {
    return view('meu-plano'); 
})->name('meu-plano');

Route::get('/competicao', function () {
    return view('competicao'); 
})->name('competicao');

Route::get('/aulas', function () {
    return view('aulas'); 
})->name('aulas');

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

require __DIR__.'/auth.php';
