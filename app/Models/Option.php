<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $table = 'options';

    protected $fillable = [
        'quiz_id',
        'option_text',
        'is_correct',
    ];

    // Option.php
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

}
