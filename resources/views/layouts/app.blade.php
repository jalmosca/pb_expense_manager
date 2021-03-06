<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Expenses Manager</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

    {{-- fontawsesome --}}
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">    

    {{-- bootstrap --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .sidelink {
            color:inherit;
            text-decoration: none;
        }
    </style>

</head>
<body class="">
    <div class="container-fluid">
            <div class="row">
                <div class="col-2 bg-dark text-white h-100 pt-5" style="min-height: 100vh; height: 100%; position: fixed">
                    @guest
                        
                    @else
                        <h3 class="text-center">{{ Auth::user()->name }}</h3>

                        <?php if( Auth::user()->role_id == 1) {?>
                        <h4 class="mt-5"><a class="sidelink" href="{{ route('home') }}">Dashboard</a></h4>
                        <h4 class="mt-5">User Management</h4>
                        <ul style="list-style-type:none">
                            <li>
                                <h5><a class="sidelink" href="{{ route('roles.index') }}">Roles</a></h5>
                            </li>
                            <li>
                                <h5><a class="sidelink" href="{{ route('users.index') }}">Users</a></h5>
                            </li>
                        </ul>
                        <?php } ?>
                        <h4 class="mt-5">Expense Management</h4>
                        <ul style="list-style-type:none">
                            <?php if( Auth::user()->role_id == 1) {?>
                                <li>
                                    <h5><a class="sidelink" href="{{ route('categories.index') }}">Expense Categories</a></h5>
                                </li>
                            <?php } ?>
                            <li>
                                <h5><a class="sidelink" href="{{ route('expenses.index') }}">Expenses</a></h5>
                            </li>
                        </ul>
                    @endguest

                </div>

                <div class="offset-2 col-10 p-0">
                    <div id="app">
                        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
                            <div class="container">
                                <a class="navbar-brand" href="{{ url('/') }}">
                                    Expenses Manager
                                </a>
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                                    <span class="navbar-toggler-icon"></span>
                                </button>

                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <!-- Left Side Of Navbar -->

                                    <!-- Right Side Of Navbar -->
                                    <ul class="navbar-nav ml-auto">
                                        <!-- Authentication Links -->
                                        @guest
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                            </li>
                                            {{-- @if (Route::has('register'))
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                                </li>
                                            @endif --}}
                                        @else

                                            <li class="nav-item">
                                                <h5 class="navbar-brand">{{ Auth::user()->name }}</h5>
                                            </li>
                                            <li class="nav-item">
                                                    <a class="nav-link" href="{{ route('users.edit',['user'=> Auth::user()->id]) }}">
                                                        Change Password
                                                    </a>
                                            </li>
                                            <li class="nav-item">
                                                    <a class="nav-link" href="{{ route('logout') }}"
                                                       onclick="event.preventDefault();
                                                                     document.getElementById('logout-form').submit();">
                                                        {{ __('Logout') }} 
                                                    </a>

                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                        @csrf
                                                    </form>
                                            </li>
                                            {{-- <li class="nav-item dropdown">
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
                                            </li> --}}
                                        @endguest
                                    </ul>
                                </div>
                            </div>
                        </nav>


        
                        
                        <main class="py-4">
                            @yield('content')
                        </main>

                    </div>
                </div>
            </div>

    </div>






    {{-- bootstrap --}}
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>
