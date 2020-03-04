<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\User;
use Illuminate\Http\Request;

class CommentsController extends Controller
{

    public function all()
    {
        $comments = Comment::get();

        foreach ($comments->toArray() as $index => $daat) {
            print_r($daat['post_id']."\n");
            print_r($daat['text']."\n");
        }

        //dd($comments->toArray());
    }
    
    public function index(Post $post)
    {
        $comments = Comment::where('post_id', $post->id)
            ->with('user')
            ->latest()
            ->get();

        return response()->json($comments);
    }

    public function store(Request $request)
    {

        request()->validate([
            'userId' => 'required|int',
            'postId' => 'required|int',
            'comment' => 'required|string',
        ]);

        $form_user = User::findOrFail($request->userId);
        $form_post = Post::findOrFail($request->postId);
        $form_comment = $request->comment;

        if($form_user->id == auth()->user()->id){

            $added_comment = Comment::create([
                'user_id' => $form_user->id,
                'post_id' => $form_post->id,
                'text'    => $form_comment,
            ]);

            return response()->json(
                array_merge(
                    $added_comment->toArray(),
                    ['user' =>
                        [
                            'id' => $form_user->id,
                            'username' => $form_user->username
                        ],
                    ]

                )
            );

        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    public function destroy(Comment $comment)
    {

        $comment_id = $comment->id;

        if($comment->user_id == auth()->user()->id) {
            return response()->json(
                [
                    'status' => $comment->delete(),
                    'id' => $comment_id,
                ]
            );
        } else {
            abort(403, 'Unauthorized action.');
        }
    }


}
