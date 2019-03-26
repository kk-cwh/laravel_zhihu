@extends('layouts.app')

@section('content')
    @include('vendor.ueditor.assets')
 <div class="container">
        @include('flash::message')
        <div class="row">
            <div class="col-md-8 col-md-offset-1">
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
            <div class="col-md-3">
                <div class="panel panel-default  question-follow">
                    <div class="panel-heading">
                        <h2>{{$question->followers_count}}</h2>
                        <span>关注者</span>
                    </div>
                    <div class="panel-body">
                        {{--<a href="/questions/{{$question->id}}/follow" class="btn btn-default  {{Auth::user()->followed($question->id)?'btn-success':''}}">--}}
                            {{--{{Auth::user()->followed($question->id)?'已关注':'关注该问题'}}--}}
                        {{--</a>--}}
                        <question-follow-button question="{{$question->id}}" user="{{Auth::id()}}"></question-follow-button>
                        <a href="/questions/{{$question->id}}/follow" class="btn btn-primary">
                            撰写答案
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ $question->answers_count }} 个答案
                    </div>
                    <div class="panel-body">

                        @foreach($question->answers as $item)
                            <div class="media">
                                <div class="media-left">
                                    <a href="#">
                                        <img class="media-object img-circle " src="{{$item->user->avatar}}" alt="64x64"
                                             style="width: 48px">
                                    </a>
                                </div>

                                <div class="media-body">
                                    <h4 class="media-heading">
                                        <a href="/user/{{$item->user->id}}">
                                            {{$item->user->name}}</a>
                                    </h4>
                                    {!! $item->body !!}
                                </div>
                            </div>


                        @endforeach


                        @if(Auth::check())

                        <form action="/questions/{{$question->id}}/answer" method="post">
                            {!! csrf_field() !!}
                            <div class="form-group {{ $errors->has('body') ? ' has-error' : '' }}">
                                <script id="container" name="body" style="height:120px;" type="text/plain">
                                    {!! old('body')  !!}
                                </script>
                                @if ($errors->has('body'))
                                <span class="help-block" >
                                    <strong> {{ $errors->first('body') }}</strong>
                                </span>
                                        @endif
                                    </div>
                                    <button class="btn btn-success pull-right" type="submit">提交答案</button>
                         </form>
                                        @else
                                    <a class="btn btn-success btn-block" href="/login">登录提交答案 </a>

                            @endif
                    </div>
                 </div>
            </div>
        </div>
    </div>



@endsection
 @section('js')
<script>
var ue = UE.getEditor('container', {
    toolbars: [
        ['bold', 'italic', 'underline', 'strikethrough', 'blockquote', 'insertunorderedlist', 'insertorderedlist', 'justifyleft','justifycenter', 'justifyright',  'link', 'insertimage', 'fullscreen']
    ],
    elementPathEnabled: true,
    enableContextMenu: true,
    autoClearEmptyNode: true,
    wordCount: true,
    imagePopup: true,
    autotypeset: {
        imageBlockLine: 'center',
        indent: false,
    }
});
ue.ready(function () {
    ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');
});

</script>
@endsection