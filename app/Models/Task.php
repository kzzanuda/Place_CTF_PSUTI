<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use phpDocumentor\Reflection\Types\Integer;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tasks';

    protected $fillable = [
      'title',
      'description_full',
      'description_short',
      'points',
    ];

    public function hasAnswer(): bool
    {
        if ($this->belongsTo(Answer::class, 'task_id')->first() != null) {
            return true;
        } else {
            return false;
        }
    }

    public function hasNext(): bool
    {
        $pagination = $this->pagination();
        if($pagination[array_key_last($pagination)] == $this->id) {
            return false;
        } else {
            return true;
        }
    }

    public function hasPrevious(): bool
    {
        $pagination = $this->pagination();
        if($pagination[array_key_first($pagination)] == $this->id) {
            return false;
        } else {
            return true;
        }
    }

    public function next()
    {
        $pagination = $this->pagination();
        $position = array_search($this->id, $pagination);
        return $pagination[$position + 1];

    }

    public function previous()
    {
        $pagination = $this->pagination();
        $position = array_search($this->id, $pagination);
        return $pagination[$position - 1];
    }

    public function pagination()
    {
        return Task::orderBy('points')->orderBy('id')->pluck('id')->toArray();
    }
}
