<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
{{--    <link rel="stylesheet" href="{{ asset('/vendor/toastr/toastr.css')}}">--}}




</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link btn-primary btn btn-sm text-light" href="{{ route('loginRegister') }}">Sign Up</a>
                        </li>
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>--}}
{{--                        </li>--}}
{{--                        @if (Route::has('register'))--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
{{--                            </li>--}}
{{--                        @endif--}}
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-3 d-flex flex-column"> <!-- Left Side Bar -->
                    @auth
                        @if(Auth()->user()->isAdmin)
                            <a href="{{route('channel.create')}}" class="btn btn-primary">Create New Channel</a>
                        @endif
                        <a href="{{route('discussion.create')}}" class="btn btn-primary  mt-2">Create New Discussion</a>
                        <div class="card mt-3 ">
                            <div class="list-group border-0">
                                <a href="#" class="list-group-item  border-left-0 border-right-0">Home</a>
                                <a href="#" class="list-group-item  border-left-0 border-right-0">Notifications  <span class="badge badge-success ml-2"> 2 unread </span> </a>
                                @if(Auth()->user()->isAdmin)
                                    <a href="{{route('channel.index')}}" class="list-group-item  border-left-0 border-right-0">Channels</a>
                                @endif
                                <a href="{{route('discussion.userDiscussions')}}" class="list-group-item  border-left-0 border-right-0">My Discussions</a>
                                <a href="#" class="list-group-item  border-left-0 border-right-0">Answered Discussions</a>
                                <a href="#" class="list-group-item  border-left-0 border-right-0">Unanswered Discussions</a>
                            </div>
                        </div>
                    @endauth

                    <div class="card mt-3 " >

                        <div class="card-header bg-white ">Channels</div>
                        <div class="list-group border-0">
                            @forelse($channels as $channel)
                                {{-- TODO: Show all discussion that has same categoryes--}}
                                <a href="#" class="list-group-item  border-left-0 border-right-0">{{ $channel->title }}</a>
                            @empty
                                <span class="list-group-item">No Channel Found</span>
                            @endforelse
                        </div>
                    </div>
                </div><!-- End of Left Side Bar -->


                <div class="col-md-8 offset-1 mx-auto m-2">
             @yield('content')
                </div>

            </div>
        </div>
    </main>
</div>

<!-- Compiled and minified JavaScript -->
<script src="{{ asset('js/app.js') }}" ></script>

<script>
    @if(Session::has('success'))
        window.toastr.success("{{Session::get('success')}}");
    @endif
</script>

</body>
</html>
