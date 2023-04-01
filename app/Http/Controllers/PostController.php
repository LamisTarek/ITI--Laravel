<?php

namespace App\Http\Controllers;

class PostController extends Controller
{
    public function index()
    {
        $allPosts = [
            [
                'id' => 1,
                'title' => 'Laravel',
                'description' => 'hello laravel',
                'posted_by' => 'Ahmed',
                'created_at' => '2023-04-01 10:00:00',
            ],

            [
                'id' => 2,
                'title' => 'PHP',
                'description' => 'hello php',
                'posted_by' => 'Mohamed',
                'created_at' => '2023-04-01 10:00:00',
            ],

            [
                'id' => 3,
                'title' => 'Javascript',
                'description' => 'hello javascript',
                'posted_by' => 'Mohamed',
                'created_at' => '2023-04-01 10:00:00',
            ],
        ];

        return view('posts.index',[
            'posts' => $allPosts,
        ]);
    }

    public function show($id)
    {
//        dd($id);
        $post = [
            'id' => 3,
            'title' => 'Javascript',
            'description' => 'hello javascript',
            'posted_by' => 'Mohamed',
            'created_at' => '2023-04-01 10:00:00',
        ];

        return view('posts.show', ['post' => $post]);
    }

    public function create()
    {
        return view('posts.create');
    }



    public function store(){
        return redirect()->route('posts.index');

    }

    public function edit()
    {
        return view('posts.edit');

    }

    public function update(){
        return redirect()->route('posts.index');
    }

    public function destory(){
        return redirect()->route('posts.index');
    }



}