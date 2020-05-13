<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- style -->
    <link href="{{ asset('style/afstyle.css') }}" rel="stylesheet">
    @yield('header')
</head>

<body>
    <img class="position-fixed w-100 h-100" src="{{asset('storage/bg.jpg')}}">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm">
            <div class="container">
                <img src="{{asset('storage/logo.png')}}" class="mr-1" height="40">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="">home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('dest.indexA')}}">dests</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('hotel.indexA')}}">hotels</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('article.indexA')}}">articles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('image.indexA')}}">images</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('event.indexA')}}">events</a>
                        </li>
                        <li class="nav-item">
                            <!-- <a class="nav-link" href="route('room.indexA')">rooms</a> -->
                        </li>
                        <li class="nav-item">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Launch demo modal
                            </button>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- body -->
        <div class="row justify-content-md-center m-0 bg-transparent">

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

            <div class="col-12 py-2 mx-1">
                <div class="list-group">
                    <a href="{{route('home')}}" class="list-group-item list-group-item-action bg-secondary text-white">
                        <img src="" style="width:40px;height:40px" alt="" class="rounded-circle border-white mr-1">
                        <h5 class="d-inline">Beranda</h5>
                    </a>
                    <a href="{{route('dest.index')}}" class="list-group-item list-group-item-action">dest</a>
                    <a href="{{route('hotel.index')}}" class="list-group-item list-group-item-action">hotel</a>
                    <a href="{{route('article.index')}}" class="list-group-item list-group-item-action">article</a>
                    <a href="{{route('image.index')}}" class="list-group-item list-group-item-action">image</a>
                    <a href="{{route('event.index')}}" class="list-group-item list-group-item-action">event</a>
                    <a href="{{route('admin.index')}}" class="list-group-item list-group-item-action">user</a>
                    <!-- <a href="{{route('room.index')}}" class="list-group-item list-group-item-action">room</a> -->
                    <form action="{{route('cart.search')}}" method="post">
                        {{csrf_field()}}
                        <button type="submit" class="list-group-item list-group-item-action">
                            Pesan
                            @if(Session::has('cart'))
                            @php
                            $cart=Session::get('cart');
                            @endphp
                            <span class="badge badge-success ml-5">{{$cart->tQty}}</span>
                            @endif
                        </button>
                    </form>
                </div>
            </div>

    </div>
  </div>
</div>

            <div class="col-md-11 py-2 mx-1 bg-limpid" style="">
                @yield('content')
            </div>
        </div>
        <!-- end_body -->
    </div>
    <!-- script -->
    @yield('script')
    <!-- bootstrap -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
</body>

</html>