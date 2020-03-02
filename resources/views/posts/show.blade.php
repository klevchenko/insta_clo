@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-12 col-md-8 offset-md-2">

            <div class="row">
                <div class="col-12 col-lg-7 mb-3 mb-lg-4">
                    <img src="/storage/{{$post->image}}" class="w-100" />

                    <form method="POST" action="/p/{{$post->id}}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}

                        <div class="form-group my-4">
                            <input type="submit" class="btn btn-block btn-sm btn-danger delete-user" value="Delete post">
                        </div>
                    </form>

                </div>

                <div class="col-12 col-lg-5">

                    <h5 class="mb-3 d-flex align-items-center">
                        <a href="/profile/{{$post->user->id}}"
                        class="d-flex align-items-center text-dark">
                            <img src="{{$post->user->profile->profileImage()}}"
                                class="rounded-circle w-100"
                                 style="max-width: 40px"
                            >
                            <span class="mx-2 d-block">
                                {{$post->user->username}}
                            </span>
                        </a>

                        <follow-button user-id="{{$post->user->id}}" follows="{{$follows}}"></follow-button>

                    </h5>

                    <p>
                        {{$post->caption}}
                    </p>

                    <br>

                    <comments-form user-id="{{auth()->user()->id}}" post-id="{{$post->id}}"></comments-form>

                </div>

            </div>

        </div>
    </div>
</div>
@endsection
