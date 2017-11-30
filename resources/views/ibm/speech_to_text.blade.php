@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">IBM Watson Speech to Text</div>
            <div class="panel-body">
                {{--@foreach($results as $key=>$arr)--}}
                {{--@foreach($arr['alternatives'] as $result)--}}
                {{--<li>{{$result['transcript']}}</li>--}}
                {{--<li>{{$result['confidence'] * 100}}%</li>--}}
                {{--@endforeach--}}
                {{--@endforeach--}}
                <form action="{{route('personality.post')}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <p><strong>What I said in the video:</strong></p>
                        <li>{{$result['sentences']}}</li>
                        <input type="hidden" name="sentences" value="{{$result['sentences']}}">

                    </div>

                    <div class="form-group">
                        <p><strong>Confidence level: </strong></p>
                        <li>{{$result['confidences']}}%</li>
                    </div>

                    <div class="form-group">
                        <button type="submit"
                                class="btn btn-primary"{{str_word_count($result['sentences'])<100 ? 'disabled':null}} >{{str_word_count($result['sentences'])>100 ? "Get personality insights report" : "Unable to get personality insights report"}}
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection