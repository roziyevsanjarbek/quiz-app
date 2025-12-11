<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/quizzes",
     *     summary="Get authenticated user's quizzes",
     *     security={{"sanctum":{}}},
     *     tags={"Quizzes"},
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of quizzes"
     *     ),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function index()
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        $quizzes = $user->quizzes()->with('questions.options')->orderBy('created_at', 'desc')->get();

        return response()->json([
            'message' => 'Quizzes fetched successfully',
            'quizzes' => $quizzes
        ], 200);
    }


    /**
     * @OA\Get(
     *     path="/api/quizzes/{id}",
     *     summary="Get one quiz by ID",
     *     tags={"Quizzes"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Quiz ID",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(response=200, description="Quiz fetched successfully"),
     *     @OA\Response(response=404, description="Quiz not found")
     * )
     */
    public function show($id)
    {
        $quiz = Quiz::with('questions.options')->findOrFail($id);

        return response()->json([
            'message' => 'Quiz fetched successfully',
            'quiz' => $quiz
        ]);
    }


    /**
     * @OA\Post(
     *     path="/api/quizzes",
     *     summary="Create a new quiz",
     *     tags={"Quizzes"},
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title","questions"},
     *             @OA\Property(property="title", type="string", example="My Quiz"),
     *             @OA\Property(property="description", type="string", example="About Laravel"),
     *             @OA\Property(
     *                 property="questions",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="question_text", type="string", example="Laravel nima?"),
     *                     @OA\Property(property="type", type="string", example="multiple_choice"),
     *                     @OA\Property(
     *                         property="options",
     *                         type="array",
     *                         @OA\Items(
     *                             @OA\Property(property="option_text", type="string", example="PHP freymvork"),
     *                             @OA\Property(property="is_correct", type="boolean", example=true)
     *                         )
     *                     )
     *                 )
     *             ),
     *         )
     *     ),
     *     @OA\Response(response=201, description="Quiz created successfully")
     * )
     */
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

        $quiz = auth()->user()->quizzes()->create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

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


    /**
     * @OA\Post (
     *     path="/api/quizzes/{quizId}",
     *     summary="Update quiz",
     *     tags={"Quizzes"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="quizId",
     *         in="path",
     *         description="Quiz ID",
     *         required=true,
     *         @OA\Schema(type="integer", example=3)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Quiz update data",
     *         @OA\JsonContent(
     *             @OA\Property(property="title", type="string", example="Updated Quiz"),
     *             @OA\Property(property="description", type="string", example="Updated description"),
     *             @OA\Property(
     *                 property="questions",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="question_text", type="string", example="Updated question text"),
     *                     @OA\Property(property="type", type="string", example="multiple_choice"),
     *                     @OA\Property(
     *                         property="options",
     *                         type="array",
     *                         @OA\Items(
     *                             @OA\Property(property="option_text", type="string", example="Updated option text"),
     *                             @OA\Property(property="is_correct", type="boolean", example=false)
     *                         )
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(response=200, description="Quiz updated successfully")
     * )
     */
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

        $quiz = auth()->user()->quizzes()->findOrFail($quizId);

        $quiz->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        $quiz->questions()->each(function ($question) {
            $question->options()->delete();
            $question->delete();
        });

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


    /**
     * @OA\Delete(
     *     path="/api/quizzes/{quizId}",
     *     summary="Delete quiz",
     *     security={{"sanctum":{}}},
     *     tags={"Quizzes"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="quizId",
     *         in="path",
     *         description="Quiz ID",
     *         required=true,
     *         @OA\Schema(type="integer", example=3)
     *     ),
     *     @OA\Response(response=200, description="Quiz deleted")
     * )
     */
    public function destroy($quizId)
    {
        $quiz = auth()->user()->quizzes()->findOrFail($quizId);

        $quiz->questions()->each(function ($question) {
            $question->options()->delete();
            $question->delete();
        });

        $quiz->delete();

        return response()->json([
            'message' => 'Quiz deleted successfully'
        ], 200);
    }


    /**
     * @OA\Get(
     *     path="/api/all-quizzes",
     *     summary="Get all quizzes with question count",
     *     tags={"Quizzes"},
     *     security={{"sanctum":{}}},
     *     @OA\Response(response=200, description="All quizzes fetched successfully")
     * )
     */
    public function allQuizzes()
    {
        $quizzes = Quiz::withCount('questions')->get();

        return response()->json([
            'status' => true,
            'quizzes' => $quizzes
        ]);
    }


    /**
     * @OA\Get(
     *     path="/api/quiz/{quizId}/{questionId}",
     *     summary="Get single question of a quiz",
     *     tags={"Quizzes"},
     *     @OA\Parameter(name="quizId", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Parameter(name="questionId", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Question fetched"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function getQuizQuestion($quizId, $questionId)
    {
        $quiz = Quiz::find($quizId);

        if (!$quiz) {
            return response()->json([
                'status' => false,
                'message' => 'Quiz topilmadi'
            ], 404);
        }

        $question = $quiz->questions()
            ->with('options')
            ->where('id', $questionId)
            ->first();

        if (!$question) {
            return response()->json([
                'status' => false,
                'message' => 'Bu quizda bunday question mavjud emas'
            ], 404);
        }

        $totalQuestions = $quiz->questions()->count();

        return response()->json([
            'status' => true,
            'quiz_id' => $quizId,
            'quiz_title' => $quiz->title,
            'question' => $question,
            'total_questions' => $totalQuestions
        ]);
    }


    /**
     * @OA\Get(
     *     path="/api/get-question-id/{quizId}",
     *     summary="Get first question ID of a quiz",
     *     tags={"Quizzes"},
     *     @OA\Parameter(name="quizId", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="First question ID"),
     *     @OA\Response(response=404, description="Questions not found")
     * )
     */
    public function getFirstQuestionId($quizId)
    {
        $firstQuestion = \App\Models\Question::where('quiz_id', $quizId)
            ->orderBy('id', 'asc')
            ->first();

        if (!$firstQuestion) {
            return response()->json([
                'status' => false,
                'message' => 'Bu quizda savollar mavjud emas'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'question_id' => $firstQuestion->id
        ]);
    }
}
