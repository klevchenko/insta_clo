<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;

use Illuminate\Http\Request;

class LikesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Post $post)
    {
        return auth()->user()->likes()->toggle($post);
    }

    public function liked()
    {
        $posts = auth()->user()->likes;
        
        return view('posts/liked', [
            'posts' => $posts,
        ]);
    }
}
