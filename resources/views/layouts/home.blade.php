@extends('layouts.app')

@section('content')
    <div class="container-fluid" id="main-container">
        <div class="row widgets">
            <div class="col-lg-2 d-none d-lg-flex pills-column flex-column">
                <div class="pills-column-title">
                    <a href="{{ route('home') }}">{{ trans('app.home_dashboard_title') }}</a>
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
                </div>
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
                                class="fas fa-gamepad"></i>Мои игры
                        </a>
                        @if($page == 'games')
                            <div>
                                @foreach($gamesList as $game)
                                    @if(!isset($game["enabled"]) || $game["enabled"] !== false)
                                        <div class="d-inline-block rounded-pill m-1 px-2 py-1 bg-secondary">
                                            <a href="/games/{{ $game["url"] }}"
                                               class="text-white text-decoration-none">{{ $game["name"] }}</a>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    @endif
                </div>
            </div>
            <div class="col-lg-10 col-sm-12">
                <div class="row">
                    <div class="col-8 header-left"><h3 class="mb-5">@yield('page-title')</h3></div>
                    <div class="col-4 d-flex justify-content-end align-items-start">
                        <div class="header-right">
                            <div class="avatar">{{ strtoupper(Auth::user()->name[0]) }}</div>
                            <div class="d-flex flex-column ms-2 me-4">
                                <div class="user-name">{{ Auth::user()->name }}</div>
                                <div class="user-email">{{ Auth::user()->email }}</div>
                            </div>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a
                                class="sign-out"
                                href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            >
                                <i class="fa fa-sign-out-alt" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        @yield('page-content')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
