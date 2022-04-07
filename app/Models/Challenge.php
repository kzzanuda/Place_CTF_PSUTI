<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'challenge';

    protected $fillable = [
        'title',
        'description',
        'url',
        'points',
        'answer',
    ];
}
