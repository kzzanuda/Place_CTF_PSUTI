<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerChallenge extends Model
{
    use HasFactory;

    protected $table = 'answers_chall';

    protected $fillable = ['user_id', 'chall_id'];
}
