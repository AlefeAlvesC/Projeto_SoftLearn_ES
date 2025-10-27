<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModuleController;


Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth']) -> group(function () {

    Route::resource('modules', ModuleController::class);

    $pages = [
        'dashboard' => 'dashboard',
        'flashcards' => 'flashcards',
        'diagramas' => 'diagramas',
        'calendario' => 'calendario',
        'revisoes' => 'revisoes',
        'informacoes' => 'informacoes',
        'configuracoes' => 'configuracoes',
        'meu-plano' => 'meu-plano',
        'competicao' => 'competicao',
        'aulas' => 'aulas',
    ];
    foreach ($pages as $uri => $view)
    {
        Route::view("/{$uri}", $view)-> name($uri);
    }
});

require __DIR__.'/auth.php';
