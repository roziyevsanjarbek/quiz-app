<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::get('/logout', [HomeController::class, 'logout'])->name('logout');

// routes/web.php
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/my-quizzes', [HomeController::class, 'myQuizzes'])->name('my-quizzes');
    Route::get('/add-quizzes', [HomeController::class, 'addQuizzes'])->name('add-quizzes');
    Route::get('/update-quizzes', [HomeController::class, 'updateQuizzes'])->name('update-quizzes');
    Route::get('/upload-quiz', [HomeController::class, 'uploadQuiz'])->name('upload-quiz');
    Route::get('/add-quiz-icon', [HomeController::class, 'subject'])->name('subject');
});

Route::get('/', [HomeController::class, 'welcome'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/user-results', [HomeController::class, 'userResult'])->name('user-results');
Route::get('/take-quiz/{quizId}', [HomeController::class, 'takeQuiz'])->name('take-quiz');
Route::get('/quizzes', [HomeController::class, 'quiz'])->name('quiz');
Route::get('/quiz/{quiz}/start', [HomeController::class, 'start'])->name('start');
Route::get('/quizzes/result', [HomeController::class, 'result'])->name('result');

