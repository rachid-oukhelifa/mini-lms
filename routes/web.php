<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\ChapitreController;
use App\Http\Controllers\SousChapitreController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ApprenantQuizController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GenerationIAController;

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

    // Routes apprenant
    Route::get('apprenant/quiz/{id}', [ApprenantQuizController::class, 'show'])->name('apprenant.quiz');
    Route::post('apprenant/quiz/{id}', [ApprenantQuizController::class, 'submit'])->name('apprenant.quiz.submit');
    Route::get('mes-notes', [NoteController::class, 'mesNotes'])->name('notes.mes_notes');

    // Routes admin
    Route::middleware('admin')->group(function () {
        Route::resource('formations', FormationController::class);
        Route::resource('chapitres', ChapitreController::class);
        Route::resource('sous_chapitres', SousChapitreController::class);
        Route::resource('quizzes', QuizController::class);
        Route::resource('notes', NoteController::class)->except(['show']);
        Route::get('questions/create', [QuestionController::class, 'create'])->name('questions.create');
        Route::post('questions', [QuestionController::class, 'store'])->name('questions.store');
        Route::delete('questions/{id}', [QuestionController::class, 'destroy'])->name('questions.destroy');
        Route::get('generation-ia', [GenerationIAController::class, 'create'])->name('generation.create');
        Route::post('generation-ia', [GenerationIAController::class, 'store'])->name('generation.store');
    });
});

require __DIR__.'/auth.php';