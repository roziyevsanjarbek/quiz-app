<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuizAttemptController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuizUploadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/quizzes', [QuizController::class, 'index']);
    Route::post('/quizzes', [QuizController::class, 'store']);
    Route::post('/quizzes/{quizId}', [QuizController::class, 'update']);
    Route::get('/quiz/{quiz}/start', [QuizAttemptController::class, 'start'])->name('quiz.start');
    Route::post('/quiz/{quiz}/submit', [QuizAttemptController::class, 'submit'])->name('quiz.submit');
    Route::get('/quiz/{quiz}/results', [QuizAttemptController::class, 'results'])->name('quiz.results');
    Route::get('/quiz/upload', [QuizUploadController::class, 'getUploadedFiles']);
    Route::post('/quiz/upload', [QuizUploadController::class, 'uploadAndParsePdf']);
    Route::post('/upload-pdf', [QuizUploadController::class, 'uploadPdf']);



});
