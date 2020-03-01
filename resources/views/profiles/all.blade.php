@extends('layouts.app')

@section('content')
    <div class="container mb-5">
        <div class="row">
            <div class="col-12">
                <h1>All users</h1>
            </div>

            @foreach($users as $user)
                <div class="col-4 pt-4">
                    <a href="/profile/{{$user->id}}">
                        <img src="{{ $user->profile->profileImage() }}" class="rounded-circle w-100" alt="">
                        <h4 class="mt-3 text-center">{{ $user->username }}</h4>

                    </a>
                </div>
            @endforeach

        </div>
    </div>
@endsection
