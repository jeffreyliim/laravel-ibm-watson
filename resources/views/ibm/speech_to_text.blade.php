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
                <p><strong>What I said in the video:</strong></p><li>{{$result['sentences']}}</li>
                <p><strong>Confidence level: </strong></p><li>{{$result['confidences']}}%</li>
            </div>
        </div>
    </div>
@endsection