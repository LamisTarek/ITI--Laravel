@extends('layouts.app')

@section('title') Index @endsection

@section('content')
    <div class="text-center">
        <a href="{{route('posts.create')}}" class="mt-4 btn btn-success">Create Post</a>
    </div>
    <table class="table mt-4">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Posted By</th>
            <th scope="col">Created At</th>
            <th scope="col">Slug</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>

        @foreach($posts as $post)
            <tr>
                <td>{{$post->id}}</td>
                <td>{{$post->title}}</td>
                @if($post->user)
                    <td>{{$post->user->name}}</td>
                @else
                    <td>Not Found</td>
                @endif
                {{-- <td>{{$post->created_at}}</td> --}}
                <td>{{$post->created_at->format('Y-m-d')}}</td>
                <td>{{$post->slug}}</td>


                <td>

                    <form action="{{ route('posts.destroy',$post->id) }}" method="Post">
                    <a href="{{route('posts.show',$post->id)}}" class="btn btn-info">View</a>
                    <a href="{{ route('posts.edit',$post->id) }}" class="btn btn-primary">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('{{ __('Are you sure you want to delete?') }}')">Delete</button>
                    </form>
                </td>
            </tr>

        @endforeach


        </tbody>

    </table>
    {{$posts->links()}}

@endsection

