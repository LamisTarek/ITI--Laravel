<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;



class PostController extends Controller
{
    public function index()
    {
        $allPosts = Post::paginate(5);
        // $allPosts = Post::all();  //select * from Posts

        return view('posts.index',[
            'posts' => $allPosts,
        ]);
    }

    public function show($id)
    {

        $post = Post::with('comments')->find($id);
        return view('posts.show', ['post' => $post]);
    }

    public function create()
    {
        $users = User::all();
        return view('posts.create',['users' => $users]);
    }



    public function store(StorePostRequest $request){
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
            Post::create($request->except('_token', 'image','post_creator') + ['image' => $imageName, "user_id"=>$request['post_creator']]);
        }else{
            Post::create([
                'title' => $request['title'],
                'description' => $request['description'],
                'user_id' => $request['post_creator'],
            ]);

        }
        return redirect()->route('posts.index');
    }

    public function edit($id)
    {
        $users = User::get();
        $post = Post::find($id);
        return view('posts.edit',[
            'posts'=> $post,
            'users' => $users,

        ]);
    }

    public function update(UpdatePostRequest $request,$id)
    {
        // $post = Post::find($id);
        $post = Post::where('id', $id)->first();
        if(!$post) {
            return redirect()->route('post.index');
        }
        if($request->hasFile('image')) {
            $oldImage = public_path('images') . '/' . $post->image;
            if(file_exists($oldImage)) {
                @unlink($oldImage);
            }
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
            $post->update($request->except('_token', 'image','post_creator') + ['image' => $imageName, "user_id"=>$request['post_creator']]);
        // $data = $request->all();
        }else{
            $post->update($request->except('_token','post_creator') + [ "user_id"=>$request['post_creator']]);
        }
        return redirect()->route('posts.index');
    }

    public function destroy($id){
        // $post = Post::find($id);

        $post = Post::where('id', $id)->first();
        if(!$post) {
            return redirect()->route('post.index');
        }
            $oldImage = public_path('images') . '/' . $post->image;
            if(file_exists($oldImage)) {
                @unlink($oldImage);
            }
            $post->delete();
        return redirect()->route('posts.index');
    }


    // store the comment
    public function storeComment(Request $request){
        $post= Post::find($request->post_id);
        $data = $request->all();
        $post->comments()->create([
            'body' => $data['body'],
        ]);
        return redirect()->back();

    }


}
