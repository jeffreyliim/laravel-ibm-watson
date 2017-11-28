@extends('layouts.app')
@section('content')
    <div class="container">

        <div class="panel panel-default">
            <div class="panel-heading">Panel heading without title</div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Post</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>{{$post->user->name}}</td>
                        <td>{{$post->post_content}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <update-post post="{{$post}}"></update-post>
    </div>
@endsection

@section('css')
    <style>
        .fade-enter-active, .fade-leave-active {
            transition: opacity .5s
        }

        .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */
        {
            opacity: 0
        }
    </style>
@endsection