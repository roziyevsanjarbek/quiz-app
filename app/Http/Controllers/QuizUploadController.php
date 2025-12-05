<?php

namespace App\Http\Controllers;
use Smalot\PdfParser\Parser;
use Illuminate\Http\Request;

class QuizUploadController extends Controller
{

    public function uploadAndParsePdf(Request $request)
    {
        // Validatsiya
        $request->validate([
            'file' => 'required|file|mimes:pdf|max:20480', // max 20 MB
        ]);


        // Papka mavjud bo‘lmasa — yaratamiz
        if (!is_dir(storage_path('app/public/quiz_uploads/'))) {
            mkdir(storage_path('app/public/quiz_uploads/'), 0777, true);
        }

        // Faylni storage/app/public/quiz_uploads ga saqlaymiz
        $path = $request->file('file')->store('quiz_uploads', 'public');

        // Serverdagi to'liq path
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

        // 2-qatorlardan keyin savollar ketadi
        $i = 2;
        while ($i < count($lines)) {
            if ($lines[$i] === "") {
                $i++;
                continue;
            }

            // Savol matni
            $questionText = $lines[$i];
            $i++;

            // Options yig‘ish
            $options = [];
            while ($i < count($lines) && preg_match('/^[A-D]\)/', $lines[$i])) {
                preg_match('/^([A-D])\)\s*(.+)$/', $lines[$i], $opt);

                $options[] = [
                    'option_text' => $opt[2],
                    'is_correct' => $opt[1] === 'A'  // A to‘g‘ri javob
                ];

                $i++;
            }

            // DB ga yozish
            $question = $quiz->questions()->create([
                'question_text' => $questionText,
                'type' => 'multiple_choice',
            ]);

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


    public function uploadPdf(Request $request)
    {
        // Validatsiya
        $request->validate([
            'file' => 'required|mimes:pdf|max:20480', // max 20 MB
        ]);

        // Papka mavjud bo‘lmasa — yaratamiz
        if (!is_dir(storage_path('app/public/quiz_uploads/'))) {
            mkdir(storage_path('app/public/quiz_uploads/'), 0777, true);
        }

        // Faylni storage/app/quiz_uploads ga saqlaymiz
        $path = $request->file('file')->store('quiz_uploads');

        // Serverdagi to'liq path
        $fullPath = storage_path('app/' . $path);

        return response()->json([
            'message' => 'PDF uploaded successfully',
            'path' => $path,          // Masalan: quiz_uploads/abc.pdf
            'full_path' => $fullPath, // Serverdagi to'liq yo'l
        ]);
    }


    public function getUploadedFiles()
    {
        $directory = storage_path('app/public/quiz_uploads');
        // Papka mavjudligini tekshirish
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
