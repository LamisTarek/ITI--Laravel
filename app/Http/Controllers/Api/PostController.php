<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\User;




class PostController extends Controller
{
    //
    public function index()
    {
        $allPosts = Post::with('user')->paginate(5);
        return PostResource::collection($allPosts);
    }

    public function show($id)
    {

        $post = Post::with('comments')->find($id);
        return new PostResource($post);
    }

    public function store(StorePostRequest $request){
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
            Post::create($request->except('_token', 'image','post_creator') + ['image' => $imageName, "user_id"=>$request['post_creator']]);
        }else{
             $post = Post::create([
                'title' => $request['title'],
                'description' => $request['description'],
                'user_id' => $request['post_creator'],
            ]);

        }
        return new PostResource($post);;
    }

}
