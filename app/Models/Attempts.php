<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attempts extends Model
{
    protected $table = 'attempts';

    protected $fillable = [
        'user_id',
        'quiz_id',
        'started_at',
        'finished_at',
        'score'
    ];
}
