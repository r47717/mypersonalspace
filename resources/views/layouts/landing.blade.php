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

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="landing-container">
    <div class="landing">
        <div class="top-row">
            <div class="top-row-wrapper">
                <div class="links">
                    Уже есть аккаунт?
                    <a href="{{ route('login')  }}">Войти</a>
                    <a class="register" href="{{ route('register')  }}">Регистрация</a>
                </div>
                <div class="title">
                    <div class="main-title">Моя личная зона</div>
                    <div class="subtitle">Место, где больше никого нет, и всё твоё</div>
                    <div class="subtitle mt-4">Здесь ты можешь...</div>
                </div>
            </div>
        </div>
        <div class="middle-row">
            <div class="row w-100">
                <div class="col-3">подмечать</div>
                <div class="col-3">формулировать</div>
                <div class="col-3">сохранять</div>
                <div class="col-3">отдыхать</div>
            </div>
        </div>
        <div class="bottom-row">
            <div class="row">
                <div class="col-3">
                    <div class="action"><i class="fas fa-graduation-cap"></i><span>Мои идеи</span></div>
                    <div class="action"><i class="fas fa-comment"></i><span>Мои цитаты</span></div>
                    <div class="action"><i class="fas fa-sticky-note"></i><span>Мои заметки</span></div>
                </div>
                <div class="col-3">
                    <div class="action"><i class="fas fa-trophy"></i><span>Мои достижения</span></div>
                    <div class="action"><i class="fas fa-rocket"></i><span>Мои задачи</span></div>
                </div>
                <div class="col-3">
                    <div class="action"><i class="fas fa-link"></i><span>Мои ссылки</span></div>
                    <div class="action"><i class="fas fa-book"></i><span>Мои книги</span></div>
                </div>
                <div class="col-3">
                    <div class="action"><i class="fas fa-gamepad"></i><span>Мои игры</span></div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
