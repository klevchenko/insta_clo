<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">

        <nav class="navbar navbar-light bg-light mb-5">
            <div class="container">
                <div class="row w-100">
                    <div class="col-12 col-md-4 d-flex align-content-center justify-content-center justify-content-md-start">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    </div>
                    <div class="col-12 col-md-8">
                    
                        <ul class="d-flex navbar-nav flex-row align-content-center justify-content-center justify-content-md-end">
                            <li class="nav-item nav-link mx-1" ><a href="{{ route('allUsers') }}">
                                <i class="fa fa-users" aria-hidden="true"></i>
                            </a></li>
                            
                            <li class="nav-item nav-link mx-1" ><a href="{{ route('likedPosts') }}">
                                <i class="fa fa-heart text-danger" aria-hidden="true"></i>
                            </a></li>

                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item nav-link mx-1" ><a href="{{ route('login') }}">Login</a></li>
                                <li class="nav-item nav-link mx-1" ><a href="{{ route('register') }}">Register</a></li>
                            @else
                                <li class="nav-item nav-link mx-1" >
                                    <a href="/profile/{{Auth::user()->id}}">
                                        {{ Auth::user()->username }}
                                    </a>
                                </li>

                                <li class="nav-item nav-link mx-1" >
                                    <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            @endguest

                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
