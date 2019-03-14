<?php

namespace App\Http\Controllers;

use App\Repositories\QuestionRepository;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionsController extends Controller
{
    protected $questionRepository;

    public function __construct(QuestionRepository $questionRepository)
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->questionRepository = $questionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = $this->questionRepository->getQuestionList();

        return view('questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('questions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|min:6|max:200',
            'body' => 'required|string|min:20',
        ]);
        $inputs = $request->only(['title', 'body', 'topics']);
        $inputs['user_id'] = auth()->user()->id;
        $question = $this->questionRepository->create($inputs);
        $topics = $this->normalizeTopic($request->input('topics'));

        if ($topics && count($topics)) {
            $question->topics()->sync($topics);
        }

        return redirect()->route('questions.show', [$question->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = $this->questionRepository->findByIdWithTopics($id);
        $isOwn = Auth::id() == $question->user_id;

        return view('questions.show', compact('question', 'isOwn'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = $this->questionRepository->findByIdWithTopics($id);

        return view('questions.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->merge(compact('id'));
        $this->validate($request, [
            'id' => 'required|exists:topics,id',
            'title' => 'required|string|min:6|max:200',
            'body' => 'required|string|min:20',
        ]);
        $inputs = $request->only(['title', 'body']);

        $question = $this->questionRepository->findById($id);

        $question->update($inputs);
        $topics = $this->normalizeTopic($request->input('topics'));

        if ($topics && count($topics)) {
            $question->topics()->sync($topics);
        }

        return redirect()->route('questions.show', [$question->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    private function normalizeTopic($topics)
    {
        return collect($topics)->map(function ($topic) {
            if (is_numeric($topic)) {
                $t = Topic::find($topic);
                if ($t) {
                    $t->increment('questions_count');

                    return (int) $topic;
                }
            }

            $newTopic = Topic::create(['name' => $topic, 'questions_count' => 1]);

            return $newTopic->id;
        });
    }
}
