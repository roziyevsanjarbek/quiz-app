<?php

namespace App\Http\Controllers;
use Smalot\PdfParser\Parser;
use Illuminate\Http\Request;

class QuizUploadController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/quiz/upload",
     *     summary="Upload a PDF file and automatically generate a quiz",
     *     description="PDF-ni yuklab, undan savollar va variantlarni avtomatik ajratib, quiz yaratadi.",
     *     tags={"Quiz Upload"},
     *     security={{"sanctum":{}}},
     *
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *                 required={"file"},
     *                 @OA\Property(
     *                     property="file",
     *                     type="string",
     *                     format="binary",
     *                     description="PDF fayl (max 20MB)"
     *                 ),
     *                 @OA\Property(
     *                     property="questions_count",
     *                     type="integer",
     *                     description="PDF dan nechta savolni random tanlab olish"
     *                 )
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Quiz created successfully"
     *     )
     * )
     */
    public function uploadAndParsePdf(Request $request)
    {
        // Validatsiya
        $request->validate([
            'file' => 'required|file|mimes:pdf|max:20480', // max 20 MB
            'questions_count' => 'nullable|integer|min:1', // nechta savol tanlash
        ]);

        $questionsCount = $request->input('questions_count', null);

        // Papka mavjud bo‘lmasa — yaratamiz
        if (!is_dir(storage_path('app/public/quiz_uploads/'))) {
            mkdir(storage_path('app/public/quiz_uploads/'), 0777, true);
        }

        // Faylni storage/app/public/quiz_uploads ga saqlaymiz
        $path = $request->file('file')->store('quiz_uploads', 'public');
        $fullPath = storage_path('app/public/' . $path);

        // PDF parser
        $parser = new Parser();
        $pdf = $parser->parseFile($fullPath);
        $text = trim($pdf->getText());

        $lines = array_values(array_filter(array_map('trim', explode("\n", $text))));

        // Title va Description (1-2 qator)
        $title = $lines[0] ?? 'Untitled Quiz';
        $description = $lines[1] ?? null;

        $quiz = auth()->user()->quizzes()->create([
            'title' => $title,
            'description' => $description,
        ]);

        // Savollarni yig‘ish
        $allQuestions = [];
        $i = 2; // 0-title, 1-description
        while ($i < count($lines)) {
            if ($lines[$i] === "") {
                $i++;
                continue;
            }

            $questionText = $lines[$i];
            $i++;

            $options = [];
            while ($i < count($lines) && preg_match('/^[A-D]\)/', $lines[$i])) {
                preg_match('/^([A-D])\)\s*(.+)$/', $lines[$i], $opt);
                $options[] = [
                    'option_text' => $opt[2],
                    'is_correct' => $opt[1] === 'A', // A - to‘g‘ri javob PDF da
                ];
                $i++;
            }

            if (!empty($options)) {
                $allQuestions[] = [
                    'question_text' => $questionText,
                    'options' => $options,
                ];
            }
        }

        // Agar $questionsCount berilgan bo‘lsa, random tanlash
        if ($questionsCount && $questionsCount < count($allQuestions)) {
            $allQuestions = collect($allQuestions)->random($questionsCount)->values()->all();
        }

        // Savollarni DB ga yozish + optionsni shuffle qilish
        foreach ($allQuestions as $q) {
            $question = $quiz->questions()->create([
                'question_text' => $q['question_text'],
                'type' => 'multiple_choice',
            ]);

            $options = $q['options'];

            shuffle($options); // variantlarni aralashtiramiz
            foreach ($options as $o) {
                $question->options()->create($o);
            }
        }

        return response()->json([
            'message' => 'Quiz created successfully',
            'quiz' => $quiz->load('questions.options'),
            'path' => $path,
            'full_path' => $fullPath,
            'url' => asset('storage/' . $path),
        ]);
    }



    /**
     * @OA\Post(
     *     path="/api/upload-pdf",
     *     summary="Upload PDF file only",
     *     description="PDF faylni serverga yuklash, lekin quiz yaratmaydi.",
     *     tags={"Quiz Upload"},
     *     security={{"sanctum":{}}},
     *
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *                 required={"file"},
     *                 @OA\Property(
     *                     property="file",
     *                     type="string",
     *                     format="binary",
     *                     description="PDF fayl"
     *                 )
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(response=200, description="PDF uploaded successfully")
     * )
     */
    public function uploadPdf(Request $request)
    {
        // Validatsiya
        $request->validate([
            'file' => 'required|mimes:pdf|max:20480', // max 20 MB
        ]);

        if (!is_dir(storage_path('app/public/quiz_uploads/'))) {
            mkdir(storage_path('app/public/quiz_uploads/'), 0777, true);
        }

        $path = $request->file('file')->store('quiz_uploads');

        $fullPath = storage_path('app/' . $path);

        return response()->json([
            'message' => 'PDF uploaded successfully',
            'path' => $path,
            'full_path' => $fullPath,
        ]);
    }



    /**
     * @OA\Get(
     *     path="/api/quiz/upload",
     *     summary="List uploaded quiz PDF files",
     *     description="Yuklangan PDF fayllarni ro‘yxatini qaytaradi.",
     *     tags={"Quiz Upload"},
     *     security={{"sanctum":{}}},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Uploaded files retrieved successfully"
     *     )
     * )
     */
    public function getUploadedFiles()
    {
        $directory = storage_path('app/public/quiz_uploads');

        if (!is_dir($directory)) {
            return response()->json([
                'message' => 'No uploaded files found',
                'files' => []
            ]);
        }

        $files = scandir($directory);
        $uploadedFiles = [];

        foreach ($files as $file) {
            if ($file === '.' || $file === '..') continue;

            $uploadedFiles[] = [
                'name' => $file,
                'url' => asset('storage/quiz_uploads/' . $file),
                'full_path' => $directory . '/' . $file
            ];
        }

        return response()->json([
            'message' => 'Uploaded files retrieved successfully',
            'files' => $uploadedFiles
        ]);
    }
}

