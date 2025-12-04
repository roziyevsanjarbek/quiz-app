<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'welcome'])->name('home');
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
Route::get('/my-quizzes', [HomeController::class, 'myQuizzes'])->name('my-quizzes');
Route::get('/add-quizzes', [HomeController::class, 'addQuizzes'])->name('add-quizzes');
Route::get('/take-quiz', [HomeController::class, 'takeQuiz'])->name('take-quiz');
Route::get('/upload-quiz', [HomeController::class, 'uploadQuiz'])->name('upload-quiz');
