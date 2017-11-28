@extends('layouts.app')
@section('head')
    <link href="/css/pace-theme-loading-bar.css" rel="stylesheet">
@endsection
@section('css')
    <style>

        /* speech to text media recorder */
        video {
            height: 400px;
            margin: 0 12px 20px 0;
            vertical-align: top;
            width: 500px;
        }

        video:last-of-type {
            margin: 0 0 20px 0;
        }

        video#gumVideo {
            margin: 0 20px 20px 0;
        }

        @media screen and (max-width: 500px) {
            button {
                font-size: 0.8em;
                width: 300px
            }
        }

        @media screen and (max-width: 720px) {
            video {
                height: 400px;
                margin: 0 10px 10px 0;
                width: 400px
            }

            video#gumVideo {
                margin: 0 10px 10px 0;
            }
        }
    </style>

    <style>
        /* page overlay when submitting IBM watson api call */
        #overlay {
            position: fixed; /* Sit on top of the page content */
            display: none; /* Hidden by default */
            width: 100%; /* Full width (cover the whole page) */
            height: 100%; /* Full height (cover the whole page) */
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5); /* Black background with opacity */
            z-index: 2; /* Specify a stack order in case you're using a different order for other elements */
            cursor: pointer; /* Add a pointer on hover */
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">Submit a Post</div>
            <div class="panel-body">
                <form method="post" action="{{route('posts.store')}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="country">Add Country</label>
                        <select name="country" id="country" class="form-control">
                            <option value="Singapore">Singapore</option>
                        </select>
                        <small id="post" class="form-text text-muted">We'll never share your email with anyone else.
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Add post</label>
                        <textarea class="form-control" name="post_content" id="post" cols="30" rows="10"></textarea>
                        <small id="post" class="form-text text-muted">We'll never share your email with anyone else.
                        </small>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
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
                {{--<div class="form-group">--}}
                {{--<video id="gum" autoplay muted></video>--}}
                {{--<video id="recorded" loop controls></video>--}}
                {{--<div>--}}
                {{--<button id="record" disabled>Start Recording</button>--}}
                {{--<button id="play" disabled>Play</button>--}}
                {{--<button id="download" disabled>Download</button>--}}
                {{--</div>--}}
                {{--</div>--}}
                <div class="form-group">
                    <form method="post" action="{{route('tone.get')}}" id="toneForm" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <input type="file" name="toneFile" accept="video/*" capture="camcorder">
                        </div>
                        <button type="submit" id="toneSubmit" class="btn btn-primary">Analyze my
                            tone
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        paceOptions = {
            ajax: false, // disabled
            document: true, // enabled
            eventLag: false, // disabled
            elements: {
                selectors: ['.toneForm']
            },
            startOnPageLoad: false,
        };
    </script>
    <script src="/js/pace.js"></script>
    <script>

        $('#toneForm').submit(function () {
            document.getElementById("overlay").style.display = "block";
            Pace.stop();
            Pace.start();
            document.getElementById('toneSubmit').setAttribute('disabled', 'true');
        });
        $('#personalityForm').submit(function () {
            document.getElementById("overlay").style.display = "block";
            Pace.stop();
            Pace.start();
        });

    </script>
@endsection