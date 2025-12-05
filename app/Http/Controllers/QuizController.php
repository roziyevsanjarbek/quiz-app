<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizController extends Controller
{

    public function index()
    {
        // Foydalanuvchi tizimga kirganligini tekshirish
        $user = auth()->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        // Foydalanuvchiga tegishli quizlarni savollar va variantlar bilan olish
        $quizzes = $user->quizzes()->with('questions.options')->orderBy('created_at', 'desc')->get();

        return response()->json([
            'message' => 'Quizzes fetched successfully',
            'quizzes' => $quizzes
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'questions' => 'required|array|min:1',
            'questions.*.question_text' => 'required|string',
            'questions.*.type' => 'required|in:multiple_choice,true_false,text',
            'questions.*.options' => 'required_if:questions.*.type,multiple_choice|array|min:1',
            'questions.*.options.*.option_text' => 'required|string',
            'questions.*.options.*.is_correct' => 'required|boolean',
        ]);


        // Quiz yaratish
        $quiz = auth()->user()->quizzes()->create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        // Questions va Options yaratish
        foreach ($request->questions as $q) {
            $question = $quiz->questions()->create([
                'question_text' => $q['question_text'],
                'type' => $q['type'],
            ]);

            if (!empty($q['options'])) {
                foreach ($q['options'] as $o) {
                    $question->options()->create([
                        'option_text' => $o['option_text'],
                        'is_correct' => $o['is_correct'],
                    ]);
                }
            }
        }

        return response()->json([
            'message' => 'Quiz created successfully',
            'quiz' => $quiz->load('questions.options')
        ], 201);
    }

    public function update(Request $request, $quizId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'questions' => 'required|array|min:1',
            'questions.*.question_text' => 'required|string',
            'questions.*.type' => 'required|in:multiple_choice,true_false,text',
            'questions.*.options' => 'required_if:questions.*.type,multiple_choice|array|min:1',
            'questions.*.options.*.option_text' => 'required|string',
            'questions.*.options.*.is_correct' => 'required|boolean',
        ]);


        // Quiz topish va foydalanuvchi egasi tekshirish
        $quiz = auth()->user()->quizzes()->findOrFail($quizId);

        // Quizni yangilash
        $quiz->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        // Eski savollar va ularning optionslarini o'chirish
        $quiz->questions()->each(function($question) {
            $question->options()->delete();
            $question->delete();
        });

        // Yangi Questions va Options yaratish
        foreach ($request->questions as $q) {
            $question = $quiz->questions()->create([
                'question_text' => $q['question_text'],
                'type' => $q['type'],
            ]);

            if (!empty($q['options'])) {
                foreach ($q['options'] as $o) {
                    $question->options()->create([
                        'option_text' => $o['option_text'],
                        'is_correct' => $o['is_correct'],
                    ]);
                }
            }
        }

        return response()->json([
            'message' => 'Quiz updated successfully',
            'quiz' => $quiz->load('questions.options')
        ], 200);

        }


}
