<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Mail;
use Naux\Mail\SendCloudTemplate;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'confirmation_token', 'is_active',
        'settings', 'questions_count', 'answers_count', 'comments_count', 'favorites_count',
        'likes_count', 'followers_count', 'followings_count',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        $bind_data = [
            'url' => url('password/reset', $token),
        ];
        $template = new SendCloudTemplate('reset_password', $bind_data);

        Mail::raw($template, function ($message) {
            $message->from('zhangykvip@126.com', 'Laravel-zhihu');
            $message->to($this->email);
        });
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'user_questions', 'user_id', 'question_id')->withTimestamps();
    }

    public function followed($questionId)
    {
        return $this->questions()->where('question_id', $questionId)->count();
    }
}
