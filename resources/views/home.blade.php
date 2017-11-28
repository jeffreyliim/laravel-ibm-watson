@extends('layouts.app')
{{--@section('head')--}}
{{--<link href="/css/pace-theme-loading-bar.css" rel="stylesheet">--}}
{{--@endsection--}}
@section('css')
    {{--<style>--}}
    {{--/* page overlay when submitting IBM watson api call */--}}
    {{--#overlay {--}}
    {{--position: fixed; /* Sit on top of the page content */--}}
    {{--display: none; /* Hidden by default */--}}
    {{--width: 100%; /* Full width (cover the whole page) */--}}
    {{--height: 100%; /* Full height (cover the whole page) */--}}
    {{--top: 0;--}}
    {{--left: 0;--}}
    {{--right: 0;--}}
    {{--bottom: 0;--}}
    {{--background-color: rgba(0, 0, 0, 0.5); /* Black background with opacity */--}}
    {{--z-index: 2; /* Specify a stack order in case you're using a different order for other elements */--}}
    {{--cursor: pointer; /* Add a pointer on hover */--}}
    {{--}--}}
    {{--</style>--}}
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in!
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">IBM Watson Personality Traits</div>
                    <div class="panel-body">
                        <form method="post" action="{{route('personality.get')}}" id="personalityForm">
                            {{csrf_field()}}
                            <div class="form-group">
                                <select name="id" id="" class="form-control">
                                    @foreach(\App\Post::all() as $post)
                                        <option value="{{$post->id}}">{{$post->id}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Get Personality Traits from Post</button>
                        </form>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">IBM Watson Tone Analyzer</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <form method="post" action="{{route('tone.get')}}" id="toneForm"
                                  enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <input type="file" name="toneFile" accept="video/*" capture="camcorder" required>
                                </div>
                                <div class="form-group">
                                    <button id="submitVideo" type="submit" class="btn btn-primary">Submit your video
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/js/spin.min.js"></script>
    <script src="/js/ladda.min.js"></script>

    <script>
        // Bind progress buttons and simulate loading progress
        Ladda.bind('#submitVideo', {
            callback: function (instance) {
                var progress = 0;
                var interval = setInterval(function () {
                    progress = Math.min(progress + Math.random() * 0.1, 1);
                    instance.setProgress(progress);
                }, 850);
            }
        });
    </script>
@endsection