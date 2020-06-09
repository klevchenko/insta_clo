<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Cache;

use Illuminate\Support\Facades\Gate;
use App\Providers;
use Intervention\Image\ImageManagerStatic as Image;

class ProfilesController extends Controller
{

    public function index($user)
    {
        $cache_time_sec = 5;

        $user = User::findOrFail($user);
        $follows = auth()->user() ? auth()->user()->following->contains($user->id) : false;

        $postCount = Cache::remember(
            'count.posts.' . $user->id,
            now()->addSecond($cache_time_sec),
            function() use ($user) {
                return $user->posts->count();
            }
        );

        $followerstCount = Cache::remember(
            'count.followers.' . $user->id,
            now()->addSecond($cache_time_sec),
            function() use ($user) {
                return $user->profile->followers->count();
            }
        );

        $followingCount = Cache::remember(
            'count.following.' . $user->id,
            now()->addSecond($cache_time_sec),
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
        $this->authorize('update', $user->profile);

        return view('profiles/edit', compact('user'));
    }

    public function update(User $user)
    {
        $this->authorize('update', $user->profile);

        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => '',
            'image' => '',
        ]);

        $img_path = '';

        if(request('image')) {

            $image       = request()->file('image');
            $img_path    = $image->getClientOriginalName();

            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(300, 300);
            $image_resize->save(public_path('images/' .$img_path));
        }

        auth()->user()->profile->update(array_merge(
            $data,
            ['image' => $img_path]
        ));

        return redirect("/profile/{$user->id}");
    }

}
