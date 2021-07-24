<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trans('app.home_dashboard_title') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="js/lang.js"></script>
    <script src="https://www.google.com/recaptcha/api.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-md shadow-sm" id="main-navbar">
    <div class="container-fluid">
        @auth
            <div class="nav-item dropdown d-lg-none">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    @if(config('features.today'))
                        <a class="dropdown-item" href="{{ route('home')  }}">Сегодня</a>
                    @endif
                    @if(config('features.thoughts'))
                        <a class="dropdown-item" href="{{ route('show-thoughts')  }}">Мои идеи</a>
                    @endif
                    @if(config('features.quotes'))
                        <a class="dropdown-item" href="{{ route('show-quotes')  }}">Мои цитаты</a>
                    @endif
                    @if(config('features.achievements'))
                        <a class="dropdown-item" href="{{ route('show-achievements')  }}">Мои достижения</a>
                    @endif
                    @if(config('features.tasks'))
                        <a class="dropdown-item" href="{{ route('show-tasks')  }}">Мои задачи</a>
                    @endif
                    @if(config('features.books'))
                        <a class="dropdown-item" href="{{ route('show-books')  }}">Мои книги</a>
                    @endif
                    @if(config('features.links'))
                        <a class="dropdown-item" href="{{ route('show-links')  }}">Мои ссылки</a>
                    @endif
                    @if(config('features.notes'))
                        <a class="dropdown-item" href="{{ route('show-notes')  }}">Мои заметки</a>
                    @endif
                    @if(config('features.shop'))
                        <a class="dropdown-item" href="{{ route('show-shop')  }}">Мой магазин</a>
                    @endif
                    @if(config('features.games'))
                        <a class="dropdown-item" href="{{ route('games')  }}">Мои игры</a>
                    @endif
                </div>
            </div>
        @endauth
        @guest
            <div class="nav-item dropdown d-lg-none">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="{{ route('register')  }}">{{ __('Register') }}</a>
                    <a class="dropdown-item" href="{{ route('login')  }}">{{ __('Login') }}</a>
                </div>
            </div>
        @endguest
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ trans('app.home_dashboard_title') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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

<div id="app">
    @yield('content')
</div>
</body>
</html>
