<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuizAttemptController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuizUploadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::get('/quizzes', [QuizController::class, 'index']);
    Route::get('/quizzes/{id}', [QuizController::class, 'show']);
    Route::delete('/quizzes/{id}', [QuizController::class, 'destroy']);
    Route::post('/quizzes', [QuizController::class, 'store']);
    Route::post('/quizzes/{quiz}/icon', [QuizController::class, 'updateQuizIcon']);
    Route::post('/quizzes/{quizId}', [QuizController::class, 'update']);
    Route::get('/quiz/upload', [QuizUploadController::class, 'getUploadedFiles']);
    Route::post('/quiz/upload', [QuizUploadController::class, 'uploadAndParsePdf']);
    Route::post('/upload-pdf', [QuizUploadController::class, 'uploadPdf']);
    Route::get('/attempt-answers', [QuizAttemptController::class, 'getAllAttemptAnswers']);
    Route::get('/attempts', [QuizAttemptController::class, 'get']);


});


Route::get('/quiz/search', [QuizAttemptController::class, 'search']);
Route::post('/quiz/{quiz}/start', [QuizAttemptController::class, 'start']);
Route::post('/attempts/answer', [QuizAttemptController::class, 'answerQuestion']);
Route::post('/quiz/finish', [QuizAttemptController::class, 'finish']);
Route::get('/attempts/{attempt}/resume', [QuizAttemptController::class, 'resume']);
Route::post('/attempts/exit', [QuizAttemptController::class, 'exitQuiz']);



Route::get('/all-quizzes', [QuizController::class, 'allQuizzes']);
Route::get('/get-question-id/{quizId}', [QuizController::class, 'getFirstQuestionId']);
Route::get('/quiz/{quizId}/{questionId}', [QuizController::class, 'getQuizQuestion']);
Route::get('/statistic-answers', [QuizAttemptController::class, 'allAttemptAnswers']);



