<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');

        $posts = Post::whereIn('user_id', $users)
            ->with('user')
            ->latest()
            ->paginate(100);

        return view('posts/index', compact('posts'));
    }

    public function create()
    {
        return view('posts/create');
    }

    public function store()
    {

        $data = request()->validate([
            'image' => 'required|image',
            'caption' => 'required',
        ]);

        $img_path = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $img_path);
        
        auth()->user()->posts()->create([
            'image' => $img_path,
            'caption' => $data['caption'],
        ]);

        return redirect('/profile/'.auth()->user()->id);
    }

    public function show(\App\Post $post)
    {
        $follows = auth()->user() ? auth()->user()->following->contains($post->user->id) : false;
        $like    = auth()->user() ? auth()->user()->likes->contains($post->id) : false;

        return view('posts/show', [
            'post' => $post,
            'follows' => $follows,
            'like' => $like,

        ]);
    }

    public function destroy(Post $post)
    {
        if($post->user_id != auth()->user()->id) {
            abort(403, 'Unauthorized action.');
        }

        if($post->delete()){
            return redirect('/profile/'.auth()->user()->id);
        } else {
            abort(403, 'Unauthorized action.');
        }

    }

}
