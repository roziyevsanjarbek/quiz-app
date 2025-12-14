<?php

namespace App\Http\Controllers;

use App\Models\QuizAttempt;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Attempt;
use App\Models\AttemptAnswer;
use App\Models\Question;
use App\Models\Option;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuizAttemptController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/quiz/{quiz}/start",
     *     summary="Start a quiz attempt",
     *     tags={"Quiz Attempts"},
     *     @OA\Parameter(
     *         name="quiz",
     *         in="path",
     *         required=true,
     *         description="Quiz ID",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"full_name"},
     *             @OA\Property(property="full_name", type="string", example="Ro'ziyev Sanjarbek")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Quiz attempt started",
     *         @OA\JsonContent(
     *             @OA\Property(property="attempt_id", type="integer", example=5)
     *         )
     *     )
     * )
     */
    public function start(Request $request, Quiz $quiz)
    {
        $request->validate([
            'full_name' => 'required|string|max:255'
        ]);

        $attempt = QuizAttempt::create([
            'quiz_id' => $quiz->id,
            'full_name' => $request->full_name,
            'total_questions' => $quiz->questions()->count()
        ]);

        return response()->json([
            'attempt_id' => $attempt->id,
            'quiz' => $quiz->load('questions.options')
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/attempts/answer",
     *     summary="Submit an answer for a question",
     *     tags={"Quiz Attempts"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"attempt_id","question_id","selected_option_id"},
     *             @OA\Property(property="attempt_id", type="integer", example=3),
     *             @OA\Property(property="question_id", type="integer", example=10),
     *             @OA\Property(property="selected_option_id", type="integer", example=42)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Answer stored",
     *         @OA\JsonContent(
     *             @OA\Property(property="your_answer", type="string", example="Laravel is a PHP framework"),
     *             @OA\Property(property="is_correct", type="boolean", example=true),
     *             @OA\Property(property="correct_answer", type="string", example="Laravel is a PHP framework"),
     *             @OA\Property(property="correct_option_id", type="integer", example=42)
     *         )
     *     )
     * )
     */
    public function answerQuestion(Request $request)
    {
        $request->validate([
            'attempt_id' => 'required|exists:quiz_attempts,id',
            'question_id' => 'required|exists:questions,id',
            'selected_option_id' => 'required|exists:options,id'
        ]);

        $attempt = QuizAttempt::findOrFail($request->attempt_id);
        $question = Question::findOrFail($request->question_id);
        $selectedOption = Option::findOrFail($request->selected_option_id);

        $correctOption = Option::where('question_id', $question->id)
            ->where('is_correct', true)
            ->first();

        $isCorrect = $selectedOption->id == $correctOption->id;

        AttemptAnswer::where('attempt_id', $attempt->id)
            ->where('question_id', $question->id)
            ->delete();

        AttemptAnswer::create([
            'attempt_id' => $attempt->id,
            'question_id' => $question->id,
            'selected_option_id' => $selectedOption->id,
            'is_correct' => $isCorrect,
        ]);

        return response()->json([
            'your_answer' => $selectedOption->option_text,
            'is_correct' => $isCorrect,
            'correct_answer' => $correctOption->option_text,
            'correct_option_id' => $correctOption->id,
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/quiz/finish",
     *     summary="Finish quiz attempt and calculate results",
     *     tags={"Quiz Attempts"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"attempt_id"},
     *             @OA\Property(property="attempt_id", type="integer", example=3)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Quiz completed",
     *         @OA\JsonContent(
     *             @OA\Property(property="full_name", type="string", example="Ro'ziyev Sanjarbek"),
     *             @OA\Property(property="correct", type="integer", example=7),
     *             @OA\Property(property="wrong", type="integer", example=3),
     *             @OA\Property(property="total", type="integer", example=10),
     *             @OA\Property(property="percentage", type="number", example=70.00)
     *         )
     *     )
     * )
     */
    public function finish(Request $request)
    {
        $request->validate([
            'attempt_id' => 'required|exists:quiz_attempts,id'
        ]);

        $attempt = QuizAttempt::findOrFail($request->attempt_id);

        $totalQuestions = $attempt->quiz->questions()->count();
        $correct = $attempt->answers()->where('is_correct', true)->count();
        $wrong = $totalQuestions - $correct;

        $attempt->update([
            'score' => $correct
        ]);

        return response()->json([
            'full_name' => $attempt->full_name,
            'correct' => $correct,
            'wrong' => $wrong,
            'total' => $totalQuestions,
            'percentage' => round(($correct / $totalQuestions) * 100, 2)
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/attempt-answers",
     *     summary="Get all attempts with answers",
     *     tags={"Quiz Attempts"},
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Attempts fetched successfully"
     *     )
     * )
     */
    public function getAllAttemptAnswers()
    {
        $attempts = Attempt::with(['quiz', 'answers'])->get();

        $attempts = $attempts->map(function ($attempt) {
            $attempt->correct_answers_count = $attempt->answers->where('is_correct', 1)->count();
            return $attempt;
        });

        return response()->json([
            'message' => 'Attempts fetched successfully',
            'attempts' => $attempts
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/attempts",
     *     summary="Get average quiz progress",
     *     tags={"Quiz Attempts"},
     *     @OA\Response(
     *         response=200,
     *         description="Progress data"
     *     )
     * )
     */
    public function get()
    {
        $attempts = Attempt::query()->with(['answers'])->get();
        $count = 0;
        $counts = 0;

        foreach ($attempts as $attempt) {
            $progress = ($attempt->score / $attempt->total_questions) * 100;
            $count = $count + $progress;
            $counts++;
        }

        $progress = ceil($count / $counts);

        return response()->json([
            'progress' => $progress . '%',
            'count' => $counts
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/quiz/search",
     *     summary="Quizlarni title bo‘yicha qidirish",
     *     tags={"Quizzes"},
     *     @OA\Parameter(
     *         name="q",
     *         in="query",
     *         required=false,
     *         description="Quiz title bo‘yicha qidiruv so‘zi",
     *         @OA\Schema(type="string", example="math")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Quizlar ro‘yxati",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="boolean", example=true),
     *             @OA\Property(
     *                 property="quizzes",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="title", type="string", example="Math Quiz"),
     *                     @OA\Property(property="description", type="string", example="Basic math quiz"),
     *                     @OA\Property(property="user_id", type="integer", example=3)
     *                 )
     *             )
     *         )
     *     )
     * )
     */

    public function search(Request $request)
    {
        $query = $request->get('q');

        $quizzes = Quiz::when($query, function ($q) use ($query) {
            $q->where('title', 'LIKE', '%' . $query . '%');
        })->get();

        return response()->json([
            'status' => true,
            'quizzes' => $quizzes
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/statistic-answers",
     *     summary="Get all attempts with answers",
     *     tags={"Quiz Attempts"},
     *     @OA\Response(
     *         response=200,
     *         description="Attempts fetched successfully"
     *     )
     * )
     */
    public function allAttemptAnswers()
    {
        $attempts = Attempt::with(['quiz'])->orderBy('created_at', 'desc')->get();


        return response()->json([
            'message' => 'Attempts fetched successfully',
            'attempts' => $attempts
        ]);
    }
}
