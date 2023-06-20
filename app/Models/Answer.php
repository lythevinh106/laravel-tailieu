<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Answer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['question_id', 'content', 'is_correct'];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
