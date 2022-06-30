

<nav class="my-navbar d-flex  justify-content-between align-items-center  w-100">


    <div class="nav-bar-left d-flex mx-4 align-items-center">
        <a class="navbar-brand" href="{{ url('/') }}">
            <h1 class="fw-bolder">Boolbnb</h1>
        </a>

        <a href="{{route('admin.apartments.index')}}">
            <h1>Dashboard</h1>
        </a>

        <a href="{{route('admin.apartments.create')}}">
            <h1>Inserisci un appartmento</h1>
        </a>
    </div>


    <!-- Right Side Of Navbar -->
    <div class="d-flex nav-bar-right mx-4">
        @guest
            
            
            <a class="my-nav-link" href="{{ route('login') }}">
                <h1>{{ __('Login') }} </h1>
            </a>
        
            @if (Route::has('register'))
                
                <a class="nav-link" href="{{ route('register') }}">
                    <h1> {{ __('Register') }} </h1>
                </a>
                
            @endif
        @else

            <a id="navbarDropdown"  href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                <h1>{{ Auth::user()->name }} </h1>
            </a>


            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                <a class="text-decoration-none d-flex justify-content-center align-items-center" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <h1>{{ __('Logout') }}</h1>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        @endguest
    </div>
    
</nav>
