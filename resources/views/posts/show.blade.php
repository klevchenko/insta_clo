@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-12 col-md-8 offset-md-2">

            <div class="row">
                <div class="col-12 col-lg-7 mb-3 mb-lg-4">
                    <img src="/images/{{$post->image}}" class="w-100" />

                    <div class="d-flex my-3">
                        <like-button post-id="{{$post->id}}" like="{{$like}}"></like-button>

                        @if($post->user->profile->is_my_profile())
                            <form method="POST" action="/p/{{$post->id}}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <input type="submit" class="btn btn-sm btn-danger mx-2 delete-user" value="Delete post">
                            </form>
                        @endif
                    </div>
                    
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

                        @if(!$post->user->profile->is_my_profile())
                            <follow-button user-id="{{$post->user->id}}" follows="{{$follows}}"></follow-button>
                        @endif
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
