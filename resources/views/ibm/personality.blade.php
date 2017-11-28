@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">IBM Watson Personality Traits</div>
            <div class="panel-body">
                @if($results!=null)
                    @foreach($results['personality'] as $personality)
                        <li>{{$personality['name']}}</li>
                        <li>{{$personality['raw_score']}}</li>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection