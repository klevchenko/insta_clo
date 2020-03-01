<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpKernel\Profiler\Profile;

use Illuminate\Support\Facades\Gate;
use App\Providers;

class ProfilesController extends Controller
{

    public function index($user)
    {
        $user = User::findOrFail($user);
        $follows = auth()->user() ? auth()->user()->following->contains($user->id) : false;

        $postCount = Cache::remember(
            'count.posts.' . $user->id,
            now()->addSecond(30),
            function() use ($user) {
                return $user->posts->count();
            }
        );

        $followerstCount = Cache::remember(
            'count.followers.' . $user->id,
            now()->addSecond(30),
            function() use ($user) {
                return $user->profile->followers->count();
            }
        );

        $followingCount = Cache::remember(
            'count.following.' . $user->id,
            now()->addSecond(30),
            function() use ($user) {
                return $user->following->count();
            }
        );

        return view('profiles/index', [
            'user' => $user,
            'follows' => $follows,
            'postCount' => $postCount,
            'followerstCount' => $followerstCount,
            'followingCount' => $followingCount,
        ]);
    }

    public function showall()
    {
        $users = User::get();

        return view('profiles/all', compact('users'));
    }

    public function edit(User $user)
    {
        return view('profiles/edit', compact('user'));
    }

    public function update(User $user)
    {
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => '',
            'image' => '',
        ]);

        $img_path = '';

        if(request('image')){
            $img_path = request('image')->store('profile', 'public');
        }

        auth()->user()->profile->update(array_merge(
            $data,
            ['image' => $img_path]
        ));
        
        return redirect("/profile/{$user->id}");
    }

}
