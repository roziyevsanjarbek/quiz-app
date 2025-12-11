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
    // Quiz boshlash
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

        //🔥 Eski javobni o‘chiramiz
        AttemptAnswer::where('attempt_id', $attempt->id)
            ->where('question_id', $question->id)
            ->delete();

        //🔥 Yangi javobni create qilamiz
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



    public function finish(Request $request)
    {
        $request->validate([
            'attempt_id' => 'required|exists:quiz_attempts,id'
        ]);

        $attempt = QuizAttempt::findOrFail($request->attempt_id);

        $totalQuestions = $attempt->quiz->questions()->count(); // quizdagi jami savollar
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

    public function getAllAttemptAnswers()
    {
        // Attemptlar bilan quiz va answers relationlarini yuklaymiz
        $attempts = Attempt::with(['quiz', 'answers'])->get();

        // Har bir attempt uchun to'g'ri javoblar sonini hisoblaymiz
        $attempts = $attempts->map(function ($attempt) {
            $attempt->correct_answers_count = $attempt->answers->where('is_correct', 1)->count();
            return $attempt;
        });

        return response()->json([
            'message' => 'Attempts fetched successfully',
            'attempts' => $attempts
        ]);
    }

    public function get()
    {
        $attempt = Attempt::query()->count();
        $attempts = Attempt::query()->with([ 'answers'])->get();
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



}
