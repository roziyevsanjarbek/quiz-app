<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttemptAnswer extends Model
{
    protected $table = 'attempt_answers';

    protected $fillable = [
        'attempt_id',
        'question_id',
        'selected_option_id',
        'answer_text',
        'is_correct',
    ];
}
