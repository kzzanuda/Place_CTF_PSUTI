<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Mail\EmailConfirm;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'university',
        'members',
        'city'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function taskAnswer($task_id)
    {
        return $this->hasMany(Answer::class)->where('task_id', $task_id)->first();
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    public function confirmAnswers(): HasMany
    {
        return $this->hasMany(Answer::class)->where('confirm', 1);
    }

    public function pointsTasks()
    {
        return $this->hasMany(Answer::class)->sum('points');
    }

    public function pointsChallenge()
    {
        return $this->belongsToMany(Challenge::class, 'answers_chall', 'user_id', 'chall_id')->sum('points');
    }

    public function points()
    {
        return $this->pointsTasks()+$this->pointsChallenge();
    }

    public function verified(): HasMany
    {
        return $this->hasMany(Answer::class)->whereNotNull('points');
    }

    public function block()
    {
        $this->active = 0;
        $this->save();
    }

    public function unblock()
    {
        $this->active = 1;
        $this->save();
    }

    public function getFormattedName(): string
    {
        $name = explode(' ', $this->name);

        if (count($name) > 2) {
            return $name[0] . ' ' . mb_substr($name[1], 0, 1, 'utf-8') . '.' . mb_substr($name[2], 0, 1, 'utf-8') . '.';
        } else {
            return $this->name;
        }
    }

    public function getCertificateName()
    {
        $file_name_1 = $this->getFormattedName();

        $fio_array = explode(' ', $this->name);

        if(count($fio_array) > 2) {
            $file_name_2 = $fio_array[0] . ' ' . $fio_array[1] . ' ' . $fio_array[2];
        } else {
            $file_name_2 = '';
        }

        $file_name_3 = $fio_array[0] . ' ' . $fio_array[1];

        return [$file_name_1, $file_name_2, $file_name_3];
    }

    public function getMembers()
    {
        return json_decode($this->members);
    }

    public function getLvlChallenge()
    {
        return $this->hasMany(AnswerChallenge::class)->max('chall_id')??0;
    }
}
