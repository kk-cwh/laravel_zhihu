@extends('layouts.app')

@section('content')
    @include('vendor.ueditor.assets')
    <div class="container">
        @include('flash::message')
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @foreach($questions as $question)
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object img-circle " src="{{$question->user->avatar}}" alt="64x64"
                                     style="width: 64px">
                            </a>
                        </div>

                        <div class="media-body">
                            <h4 class="media-heading">
                                <a href="/questions/{{$question->id}}">
                                    {{$question->title}}</a>
                            </h4>
                            {{$question->user->name}}
                        </div>
                    </div>


                @endforeach
            </div>
        </div>
    </div>



@endsection
