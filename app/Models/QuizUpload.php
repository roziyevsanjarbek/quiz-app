<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizUpload extends Model
{
    protected $table = 'quiz_uploads';

    protected $fillable = [
        'user_id',
        'file_path',
        'status',
    ];
}
