@extends('layouts.app')

@section('title') Edit @endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{route('posts.update', $posts->id)}} " enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input  type="text" class="form-control" name="title" value="{{$posts->title}}" >
        </div>
        <div class="mb-3">
            <label  class="form-label">Description</label>
            <textarea class="form-control"  rows="3" name="description">{{$posts->description}}</textarea>
        </div>

        <div class="mb-3">
            <label  class="form-label">Post Creator</label>
            <select class="form-control" name="post_creator">
            @foreach($users as $user)
                <option value="{{$user->id}}"@if ($user->id==$posts->user_id) selected
                @endif>{{$user->name}}</option>
            @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="formFile" class="form-label">Image</label>
            <input class="form-control" type="file" id="formFile" name="image">
        </div>

        <button class="btn btn-success">Update</button>
    </form>
@endsection
