<?php

namespace App\Http\Controllers;

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
    public function start(Quiz $quiz)
    {
        // Foydalanuvchi allaqachon boshlagan bo‘lsa, shu attemptni qaytarish
        $attempt = Attempt::firstOrCreate(
            ['quiz_id' => $quiz->id, 'user_id' => Auth::id(), 'finished_at' => null],
            ['started_at' => now()]
        );

        // Quiz va savollar bilan blade qaytarish
        $questions = $quiz->questions()->with('options')->get();

        return view('quiz.attempt', compact('quiz', 'questions', 'attempt'));
    }

    // Quiz submit (javoblarni saqlash)
    public function submit(Request $request, Quiz $quiz)
    {
        $attempt = Attempt::where('quiz_id', $quiz->id)
            ->where('user_id', Auth::id())
            ->whereNull('finished_at')
            ->firstOrFail();

        $request->validate([
            'answers' => 'required|array'
        ]);

        DB::beginTransaction();
        try {
            $score = 0;

            foreach ($request->answers as $questionId => $answerData) {
                $question = Question::findOrFail($questionId);

                if ($question->type === 'multiple_choice') {
                    $selectedOptionId = $answerData['selected_option_id'] ?? null;
                    $option = Option::find($selectedOptionId);

                    $isCorrect = $option ? $option->is_correct : false;
                    if ($isCorrect) $score++;

                    AttemptAnswer::updateOrCreate(
                        ['attempt_id' => $attempt->id, 'question_id' => $questionId],
                        [
                            'selected_option_id' => $selectedOptionId,
                            'is_correct' => $isCorrect,
                        ]
                    );
                } else {
                    // text savollar
                    $answerText = $answerData['answer_text'] ?? null;

                    AttemptAnswer::updateOrCreate(
                        ['attempt_id' => $attempt->id, 'question_id' => $questionId],
                        [
                            'answer_text' => $answerText,
                        ]
                    );
                }
            }

            // Attemptni update qilish
            $attempt->update([
                'finished_at' => now(),
                'score' => $score
            ]);

            DB::commit();

            return redirect()->route('quiz.results', $quiz)->with('success', 'Quiz submitted successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // Natijalar
    public function results(Quiz $quiz)
    {
        $attempt = Attempt::where('quiz_id', $quiz->id)
            ->where('user_id', Auth::id())
            ->latest()
            ->firstOrFail();

        $answers = $attempt->attemptAnswers()->with('question.options')->get();

        return view('quiz.results', compact('quiz', 'attempt', 'answers'));
    }
}
