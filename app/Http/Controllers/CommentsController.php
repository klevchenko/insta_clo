<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request){

        request()->validate([
            'userId' => 'required|int',
            'postId' => 'required|int',
            'comment' => 'required|string',
        ]);

        $form_user = User::findOrFail($request->userId);
        $form_post = Post::findOrFail($request->postId);

        if($form_user->id == auth()->user()->id){

            dd(
                $form_user,
                $form_post,
                $request->all()
            );

        }


    }
}
