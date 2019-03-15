<?php

namespace App\Http\Controllers;

use App\Repositories\AnswerRepository;
use Illuminate\Http\Request;
use Auth;

class AnswerController extends Controller
{
    protected $answerRepository;

    public function __construct(AnswerRepository $answerRepository)
    {
//        $this->middleware('auth')->except(['index', 'show']);
        $this->answerRepository = $answerRepository;
    }

    public function store(Request $request, $questionId)
    {
        $inputs = $request->only(['body']);
        $inputs['question_id'] = $questionId;
        $inputs['user_id'] = Auth::id();
        $answer = $this->answerRepository->create($inputs);
        $answer->question()->increment('answers_count');

        return back();
    }
}
