@extends('layouts.app')

@section('content')
    <div class="container-fluid" id="main-container">
        <div class="row widgets">
            <div class="col-lg-2 d-none d-lg-flex pills-column flex-column">
                <div class="pills-column-title">{{ trans('app.home_dashboard_title') }}</div>
                <div class="nav flex-column nav-pills">
                    @if(config('features.today'))
                        <a class="nav-link <?= $page == 'today' ? 'active' : '' ?>" href="/"><i
                                class="far fa-calendar-alt"></i>Сегодня</a>
                    @endif
                    @if(config('features.thoughts'))
                        <a class="nav-link <?= $page == 'thoughts' ? 'active' : '' ?>" href="/thoughts"><i
                                class="fas fa-graduation-cap"></i>Мои идеи</a>
                    @endif
                    @if(config('features.quotes'))
                        <a class="nav-link <?= $page == 'quotes' ? 'active' : '' ?>" href="/quotes"><i
                                class="fas fa-comment"></i>Мои цитаты</a>
                    @endif
                    @if(config('features.achievements'))
                        <a class="nav-link <?= $page == 'achievements' ? 'active' : '' ?>" href="/achievements"><i
                                class="fas fa-trophy"></i>Мои достижения</a>
                    @endif
                    @if(config('features.tasks'))
                        <a class="nav-link <?= $page == 'tasks' ? 'active' : '' ?>" href="/tasks"><i
                                class="fas fa-rocket"></i>Мои задачи</a>
                    @endif
                    @if(config('features.books'))
                        <a class="nav-link <?= $page == 'books' ? 'active' : '' ?>" href="/books"><i
                                class="fas fa-book"></i>Мои книги</a>
                    @endif
                    @if(config('features.links'))
                        <a class="nav-link <?= $page == 'links' ? 'active' : '' ?>" href="/links"><i
                                class="fas fa-link"></i>Мои ссылки</a>
                    @endif
                    @if(config('features.notes'))
                        <a class="nav-link <?= $page == 'notes' ? 'active' : '' ?>" href="/notes"><i
                                class="fas fa-sticky-note"></i>Мои заметки</a>
                    @endif
                    @if(config('features.shop'))
                        <a class="nav-link <?= $page == 'shop' ? 'active' : '' ?>" href="/shop"><i
                                class="fas fa-shopping-cart"></i>Мой магазин</a>
                    @endif
                    @if(config('features.games'))
                        <a class="nav-link <?= $page == 'games' ? 'active' : '' ?>" href="/games"><i
                                class="fas fa-gamepad"></i>Мои игры</a>
                    @endif
                </div>
            </div>
            <div class="col-lg-10 col-sm-12">
                @yield('page-content')
            </div>
        </div>
    </div>
@endsection
