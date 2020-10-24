@extends('layouts.app')

@section('content')
    <div class="container-fluid" id="main-container">
        <div class="row widgets">
            <div class="col-lg-2 pills-column d-none d-lg-flex">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link <?= $page == 'today' ? 'active' : '' ?>" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Сегодня</a>
                    <a class="nav-link <?= $page == 'thoughts' ? 'active' : '' ?>" id="v-pills-thoughts-tab" data-toggle="pill" href="#v-pills-thoughts" role="tab" aria-controls="v-pills-thoughts" aria-selected="false">Мои мысли</a>
                    <a class="nav-link <?= $page == 'quotes' ? 'active' : '' ?>" id="v-pills-cit-tab" data-toggle="pill" href="#v-pills-cit" role="tab" aria-controls="v-pills-cit" aria-selected="false">Мои цитаты</a>
                    <a class="nav-link <?= $page == 'achievements' ? 'active' : '' ?>" id="v-pills-achievements-tab" data-toggle="pill" href="#v-pills-achievements" role="tab" aria-controls="v-pills-achievements" aria-selected="false">Мои достижения</a>
                    <a class="nav-link <?= $page == 'tasks' ? 'active' : '' ?>" id="v-pills-tasks-tab" data-toggle="pill" href="#v-pills-tasks" role="tab" aria-controls="v-pills-tasks" aria-selected="false">Мои задачи</a>
                    <a class="nav-link <?= $page == 'books' ? 'active' : '' ?>" id="v-pills-books-tab" data-toggle="pill" href="#v-pills-books" role="tab" aria-controls="v-pills-books" aria-selected="false">Мои книги</a>
                    <a class="nav-link <?= $page == 'links' ? 'active' : '' ?>" id="v-pills-links-tab" data-toggle="pill" href="#v-pills-links" role="tab" aria-controls="v-pills-links" aria-selected="false">Мои ссылки</a>
                    <a class="nav-link <?= $page == 'wishlist' ? 'active' : '' ?>" id="v-pills-wishlist-tab" data-toggle="pill" href="#v-pills-wishlist" role="tab" aria-controls="v-pills-wishlist" aria-selected="false">Мой вишлист</a>
                    <a class="nav-link <?= $page == 'docs' ? 'active' : '' ?>" id="v-pills-docs-tab" data-toggle="pill" href="#v-pills-docs" role="tab" aria-controls="v-pills-docs" aria-selected="false">Мои документы</a>
                    <a class="nav-link <?= $page == 'red' ? 'active' : '' ?>" id="v-pills-red-tab" data-toggle="pill" href="#v-pills-red" role="tab" aria-controls="v-pills-red" aria-selected="false">Красная зона</a>
                </div>
            </div>
            <div class="col-lg-10 col-sm-12">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade <?= $page == 'today' ? 'show active' : '' ?>" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <today></today>
                        @if(false)
                        <div class="row mt-4">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">Напоминания</div>
                                    <div class="card-body">
                                        <p><em>Сегодня нет напоминаний</em></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="tab-pane fade <?= $page == 'thoughts' ? 'show active' : '' ?>" id="v-pills-thoughts" role="tabpanel" aria-labelledby="v-pills-thoughts-tab">
                        <thoughts></thoughts>
                        <div class="row">
                            <div class="col-6">
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade <?= $page == 'quotes' ? 'show active' : '' ?>" id="v-pills-cit" role="tabpanel" aria-labelledby="v-pills-cit-tab">

                    </div>
                    <div class="tab-pane fade <?= $page == 'achievements' ? 'show active' : '' ?>" id="v-pills-achievements" role="tabpanel" aria-labelledby="v-pills-achievements-tab">

                    </div>
                    <div class="tab-pane fade <?= $page == 'tasks' ? 'show active' : '' ?>" id="v-pills-tasks" role="tabpanel" aria-labelledby="v-pills-tasks-tab">
                        <div class="row tasks">
                            <div class="col-12">
                                <tasks></tasks>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade <?= $page == 'books' ? 'show active' : '' ?>" id="v-pills-books" role="tabpanel" aria-labelledby="v-pills-books-tab">
                        <books></books>
                    </div>
                    <div class="tab-pane fade <?= $page == 'links' ? 'show active' : '' ?>" id="v-pills-links" role="tabpanel" aria-labelledby="v-pills-links-tab">
                        @include('pages.links.index')
                    </div>
                    <div class="tab-pane fade <?= $page == 'wishlist' ? 'show active' : '' ?>" id="v-pills-wishlist" role="tabpanel" aria-labelledby="v-pills-wishlist-tab">

                    </div>
                    <div class="tab-pane fade <?= $page == 'docs' ? 'show active' : '' ?>" id="v-pills-docs" role="tabpanel" aria-labelledby="v-pills-docs-tab">

                    </div>
                    <div class="tab-pane fade <?= $page == 'red' ? 'show active' : '' ?>" id="v-pills-red" role="tabpanel" aria-labelledby="v-pills-red-tab">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
