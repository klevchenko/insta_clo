<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->belongsToMany(Comment::class);
    }

    // delete all comments belongs to post
    protected static function boot()
    {
        parent::boot();
    
        static::deleting(
            function ($post){
                Comment::where('post_id', $post->id)->delete();
            }
        );
    }

    public function likes()
    {
        return $this->belongsToMany(User::class);
    }

}
