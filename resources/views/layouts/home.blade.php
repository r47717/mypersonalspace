@extends('layouts.app')

@section('content')
    <div class="container-fluid" id="main-container">
        <div class="row widgets">
            <div class="col-lg-2 d-none d-lg-flex pills-column">
                <div class="nav flex-column nav-pills">
                    <a class="nav-link <?= $page == 'today' ? 'active' : '' ?>" href="/" >Сегодня</a>
                    <a class="nav-link <?= $page == 'thoughts' ? 'active' : '' ?>" href="/thoughts" >Мои мысли</a>
                    <a class="nav-link <?= $page == 'quotes' ? 'active' : '' ?>" href="/cit" >Мои цитаты</a>
                    <a class="nav-link <?= $page == 'achievements' ? 'active' : '' ?>" href="/achievements" >Мои достижения</a>
                    <a class="nav-link <?= $page == 'tasks' ? 'active' : '' ?>" href="/tasks" >Мои задачи</a>
                    <a class="nav-link <?= $page == 'books' ? 'active' : '' ?>" href="/books" >Мои книги</a>
                    <a class="nav-link <?= $page == 'links' ? 'active' : '' ?>" href="/links" >Мои ссылки</a>
                    <a class="nav-link <?= $page == 'notes' ? 'active' : '' ?>" href="/notes" >Мои заметки</a>
                    <a class="nav-link <?= $page == 'files' ? 'active' : '' ?>" href="/files" >Мои документы</a>
                    <a class="nav-link <?= $page == 'red' ? 'active' : '' ?>" href="/red" >Красная зона</a>
                </div>
            </div>
            <div class="col-lg-10 col-sm-12">
                @yield('page-content')
            </div>
        </div>
    </div>
@endsection
