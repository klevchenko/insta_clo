<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class)->orderBy('created_at', 'DESC');
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::created(
            function ($user){
                Profile::create([
                    'user_id' => $user->id,
                    'title' => $user->username
                ]);
            }
        );
    }

    public function following()
    {
        return $this->belongsToMany(Profile::class);
    }

    public function comments()
    {
        return $this->belongsToMany(Comment::class);
    }

    public function likes()
    {
        return $this->belongsToMany(Post::class);
    }

}
