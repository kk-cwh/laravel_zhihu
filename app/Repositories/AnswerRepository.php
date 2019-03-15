<?php

namespace App\Repositories;

use App\Answer;

class AnswerRepository
{
    public function create(array $inputs)
    {
        return Answer::create($inputs);
    }
}
