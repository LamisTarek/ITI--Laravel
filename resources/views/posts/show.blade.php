@extends('layouts.app')

@section('title') Show @endsection

@section('content')
    <div class="card mt-4">
        <div class="card-header">
            Post Info
        </div>
        <div class="card-body">
            <h5 class="card-title">Title: {{$post['title']}}</h5>
            <p class="card-text">Description: {{$post['description']}}</p>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            Post Creator Info
        </div>
        <div class="card-body">
            <h5 class="card-title">Special title treatment</h5>
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        </div>
    </div>
   {{$post->image}}
    @if ($post->image)
        <div class="card mt-4 text-center">
            <div class="card-header">
                <h1>Post Image</h1>
            </div>
            <div class="card-body">
                <img src="{{ asset('images/' . $post->image) }}" alt="Post Image" class="img-fluid">
            </div>
        </div>
    @endif
    <br/>
    <h4 class="text-center">Display Comments</h4>

    @include('posts.commentsDisplay', ['comments' => $post->comments, 'post_id' => $post->id])

    <hr/>
    <h4 class="my-1">Add comment</h4>
    <form method="post" action="{{ route('posts.storeComment') }}">
        @csrf
        <div class="form-group">
            <textarea class="form-control" name="body"></textarea>
            <input type="hidden" name="post_id" value="{{ $post->id }}" />
        </div>
        <div class="form-group mt-2">
            <input type="submit" class="btn btn-success" value="Add Comment" />
        </div>
    </form>

@endsection
