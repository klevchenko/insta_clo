@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row mb-5">

            @foreach($posts as $post)
                <div class="col-12 col-lg-4 pt-4">
                    <a href="/p/{{$post->id}}">
                        <img src="/images/{{ $post->image }}" class="w-100 mb-2" alt="">
                    </a>
                </div>
            @endforeach

        </div>

    </div>
@endsection
