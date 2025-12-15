<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model
{

    protected $fillable = [
        'quiz_id',
        'full_name',
        'score',
        'is_finished',
        'total_questions',
    ];

    // Quiz bilan bog'lanish
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    // Har bir urinishning javoblari
    public function answers()
    {
        return $this->hasMany(AttemptAnswer::class, 'attempt_id');
    }
}
