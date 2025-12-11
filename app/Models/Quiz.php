<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'quizzes';

    protected $fillable = [
        'user_id',
        'title',
        'description',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    // Quiz.php
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function attempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }




}
