<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $table = 'answers';

    protected $fillable = ['user_id', 'task_id', 'answer', 'confirm'];

    public function isConfirm(): bool
    {
        if ($this->first() != null or !$this->first()->confirm) {
            return false;
        } else {
            return true;
        }
    }
}
