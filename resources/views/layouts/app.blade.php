<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Boolbnb @yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/admin.js') }}" defer></script>
   {{--  <script src="https://js.braintreegateway.com/web/dropin/1.8.1/js/dropin.min.js"></script> --}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


    <!--Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" @yield('css')>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md p-0 navbar-light bg-white shadow-sm fixed-top" id="header-container">
            <div class="container d-flex">
                <a class="me-5 my-text" data-text="BoolBNB" href="{{ url('/') }}">
                    BoolBNB
                </a>
                {{-- <h4 class=" mb-0 mt-0" style=" color:deepskyblue">Benvenuto/a {{Auth::user()['name']}} !</h4> --}}
                {{--  <a class="text-decoration-none fs-4"  href="{{route('admin.apartments.index')}}">{{ Auth::user()->name }}</a> --}}
                <div id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto menu-desktop">
                        <!-- Authentication Links -->



                        @guest
                            <li class="nav-item">
                                <a class="nav-link fs-5" style="color: deepskyblue;" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link fs-5" style="color: deepskyblue;" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                                </li>
                            @endif
                        @else
                            <div class=" d-flex justify-content-center align-items-center">

                                <a class=" text-decoration-none me-2 fs-5 my-link" href="{{route('admin.apartments.index')}}">Dashboard</a>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown"  href="{{route('admin.apartments.index')}}" role="button" aria-expanded="false">
                                        {{ Auth::user()->name }}
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </div>
                        @endguest
                    </ul>
                    <!--MENU MOBILE-->
                    <details id="mobile-menu">
                        <summary>
                            <div id="burger">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </summary>
                        <nav class="my-nav">
                            <ul class="p-4">
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
                                        <li>
                                            <a class="text-decoration-none me-2 fs-5" href="#" role="button" aria-expanded="false">
                                                {{ Auth::user()->name }}
                                            </a>
                                        </li>
                                        <li>
                                            <a class=" text-decoration-none me-2 fs-5" href="{{route('admin.apartments.index')}}">Dashboard</a>
                                        </li>
                                        <li>

                                            <div>
                                                <a class="text-decoration-none me-2 fs-5" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                                    {{ __('Logout') }}
                                                </a>

                                                <form class="text-decoration-none me-2 fs-5" id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                            </div>
                                        </li>
                                @endguest
                                <li>
                                    <a class="text-decoration-none me-2 fs-5" href="{{ url('/') }}">
                                        Homepage
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </details>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    {{-- # yield script custom blade --}}
    @yield('script')
</body>
</html>
