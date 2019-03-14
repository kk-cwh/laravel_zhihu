<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'title', 'body', 'user_id', 'comments_count', 'followers_count', 'answers_count', 'close_comment', 'is_hidden',
    ];

    public function topics()
    {
        return $this->belongsToMany(Topic::class, 'question_topics')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
