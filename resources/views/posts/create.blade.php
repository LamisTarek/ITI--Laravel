@extends('layouts.app')

@section('title') Create @endsection

@section('content')

    <h1>Create Post</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{route('posts.store')}}" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input  type="text" name="title" class="form-control" >
        </div>
        <div class="mb-3">
            <label  class="form-label">Description</label>
            <textarea class="form-control" name="description"  rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label  class="form-label">Post Creator</label>
            <select class="form-control" name="post_creator">
            @foreach($users as $user)
                <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Image</label>
            <input class="form-control" type="file" id="formFile" name="image">
        </div>

        <button type="submit" class="btn btn-success">Submit</button>
    </form>
@endsection
