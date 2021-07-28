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

<div class="container-fluid noauth-container">
    <div class="row h-100">
        <div class="col-2 bg-white noauth-left-col">
            <a href="{{ route('home') }}">{{ trans('app.home_dashboard_title') }}</a>
        </div>
        <div class=" col-6 noauth-middle-col">
            <div id="app">
                @yield('content')
            </div>
        </div>
        <div class="col-4 noauth-right-col">
            @if (Route::is('register'))
                <div class="link-container">
                    <div>Уже есть аккаунт?</div>
                    <a href="{{ route('login')  }}">Войти</a>
                </div>
            @endif
            @if (Route::is('login'))
                <div class="link-container">
                    <div>Нет аккаунта?</div>
                    <a href="{{ route('register')  }}">Зарегистрироваться</a>
                </div>
            @endif
        </div>
    </div>
</div>

</body>
</html>
