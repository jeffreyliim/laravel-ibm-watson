@extends('layouts.app')
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

    </div>

@endsection
