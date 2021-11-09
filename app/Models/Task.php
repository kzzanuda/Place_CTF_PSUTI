<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tasks';

    public function hasAnswer(): bool
    {
        if ($this->belongsTo(Answer::class, 'task_id')->where('user_id', Auth::id())->first() != null) {
            return true;
        } else {
            return false;
        }
    }

    public function hasNext(): bool
    {
        if ($this->where('id', '>', $this->id)->first() != null) {
            return true;
        } else {
            return false;
        }

    }

    public function hasPrevious(): bool
    {
        if ($this->where('id', '<', $this->id)->first() != null) {
            return true;
        } else {
            return false;
        }

    }
}
