@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row mb-5">

            @foreach($posts as $post)
                <div class="col-12 col-lg-4 pt-4">
                    <a href="/p/{{$post->id}}">
                        <img src="/storage/{{ $post->image }}" class="w-100 mb-2" alt="">
                    </a>
                    <p>
                        <a href="/profile/{{$post->user->id}}"
                           class="text-dark">
                            <b class="mr-2">{{$post->user->username}}</b>
                        </a>
                        {{$post->caption}}
                    </p>

                </div>
            @endforeach

        </div>

        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        </div>

    </div>
@endsection
