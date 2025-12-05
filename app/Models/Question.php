<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    protected $fillable = [
        'quiz_id',
        'question_text',
        'question_type',
    ];

    public function options()
    {
        return $this->hasMany(Option::class);
    }
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

}
