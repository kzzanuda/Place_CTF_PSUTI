<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerChallange extends Model
{
    use HasFactory;

    protected $table = 'answers';

    protected $fillable = ['user_id', 'chall_id'];
}
