<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];

    public function profileImage()
    {
        return $this->image ? '/storage/'.$this->image : 'https://via.placeholder.com/150';
    }

    public function is_my_profile()
    {
        if(!isset(auth()->user()->id)){
            return false;
        }

        return auth()->user()->id == $this->user_id;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class);
    }

}
