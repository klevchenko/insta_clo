@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
       
       <div class="col col-md-4 pt-3 p-lg-5">
            <img src="{{ $user->profile->profileImage() }}" class="rounded-circle w-100" alt="">
       </div>
       <div class="col col-md-8 pt-3 pt-lg-5">
            <div class="d-flex align-items-center">
                <h1>{{ $user->username }}</h1>

                @if(!$user->profile->is_my_profile())
                    <follow-button user-id="{{$user->id}}" follows="{{$follows}}"></follow-button>
                @endif
            </div>
            
            <div class="d-flex flex-wrap">
                <div class="pr-4 mt-2"><strong>{{ $postCount }}</strong> posts</div>
                <div class="pr-4 mt-2"><strong>{{ $followerstCount }}</strong> followers</div>
                <div class="pr-4 mt-2"><strong>{{ $followingCount  }}</strong> following</div>

                @can('update', $user->profile)
                    <div class="pr-2 mt-2"><a href="/profile/{{ $user->id }}/edit">Edit profile</a></div>
                    <div class=" mt-2"><a href="/p/create">New post</a></div>
                @endcan
            </div>

            <div class="pt-3 font-weight-bold">
               {{ $user->profile->title ?? '' }}
            </div>

            <div class="pt-3">
                {{ $user->profile->description ?? '' }}
            </div>

            <div>
                <a href="##">{{ $user->profile->url ?? 'N\A' }}</a>
            </div>
            
       </div>
       
    </div>

    <div class="row mb-5">

        @foreach($user->posts as $post)
            <div class="col-4 pt-4">
                <a href="/p/{{$post->id}}">
                    <img src="/images/{{ $post->image }}" class="w-100" alt="">
                </a>
            </div>
        @endforeach

    </div>

</div>
@endsection
