<?php

namespace App\Repositories;

use App\Question;

class QuestionRepository
{
    public function create(array $inputs)
    {
        return  Question::create($inputs);
    }

    public function findByIdWithTopics(int $id)
    {
        return Question::with(['topics', 'answers'])->find($id);
    }

    public function findById(int $id)
    {
        return  Question::find($id);
    }

    public function getQuestionList()
    {
        return Question::with(['topics', 'user'])->latest('updated_at')->get();
    }
}
