@extends('layouts.app')

@section('content')
    @include('vendor.ueditor.assets')
    <div class="container">
        @include('flash::message')
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{$question->title}}
                        @foreach($question->topics as $topic)
                            <a class="topic " href="/topics/{{$topic->id}}">{{$topic->name}}</a>
                            @endforeach
                    </div>

                    <div class="panel-body">
                        {!! $question->body !!}
                        <div class="form-group">
                            @if($isOwn)
                                <span class="edit"> <a href="/questions/{{$question->id}}/edit">编辑</a></span>
                            @endif
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>



@endsection
