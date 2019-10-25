@extends('layouts.app')

@section('content')
    <div class="container-fluid" id="main-container">
        <div class="row widgets">
            <div class="col-lg-2 pills-column d-none d-lg-flex">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Сегодня</a>
                    <a class="nav-link" id="v-pills-thoughts-tab" data-toggle="pill" href="#v-pills-thoughts" role="tab" aria-controls="v-pills-thoughts" aria-selected="false">Мои мысли</a>
                    <a class="nav-link" id="v-pills-cit-tab" data-toggle="pill" href="#v-pills-cit" role="tab" aria-controls="v-pills-cit" aria-selected="false">Мои цитаты</a>
                    <a class="nav-link" id="v-pills-achievements-tab" data-toggle="pill" href="#v-pills-achievements" role="tab" aria-controls="v-pills-achievements" aria-selected="false">Мои достижения</a>
                    <a class="nav-link" id="v-pills-tasks-tab" data-toggle="pill" href="#v-pills-tasks" role="tab" aria-controls="v-pills-tasks" aria-selected="false">Мои задачи</a>
                    <a class="nav-link" id="v-pills-books-tab" data-toggle="pill" href="#v-pills-books" role="tab" aria-controls="v-pills-books" aria-selected="false">Мои книги</a>
                    <a class="nav-link" id="v-pills-links-tab" data-toggle="pill" href="#v-pills-links" role="tab" aria-controls="v-pills-links" aria-selected="false">Мои ссылки</a>
                    <a class="nav-link" id="v-pills-wishlist-tab" data-toggle="pill" href="#v-pills-wishlist" role="tab" aria-controls="v-pills-wishlist" aria-selected="false">Мой вишлист</a>
                    <a class="nav-link" id="v-pills-docs-tab" data-toggle="pill" href="#v-pills-docs" role="tab" aria-controls="v-pills-docs" aria-selected="false">Мои документы</a>
                    <a class="nav-link" id="v-pills-red-tab" data-toggle="pill" href="#v-pills-red" role="tab" aria-controls="v-pills-red" aria-selected="false">Красная зона</a>
                </div>
            </div>
            <div class="col-lg-10 col-sm-12">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <div class="row">
                            <div class="col-xl-2 col-lg-3 mb-2 mb-lg-0">
                                <div class="card">
                                    <div class="card-header">Настроение</div>
                                    <div class="card-body d-flex justify-content-center">
                                        <mood></mood>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-5 col-lg-4 mb-2 mb-lg-0">
                                <div class="card h-100">
                                    <div class="card-header">Цитата дня</div>
                                    <div class="card-body">
                                        <quote></quote>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-5 col-lg-5">
                                <div class="card h-100">
                                    <div class="card-header">Сверх-идея</div>
                                    <div class="card-body">
                                        <textarea name="brilliant-idea" class="w-100 h-100"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-12">
                                <div class="card accomplishments">
                                    <div class="card-header">Достижения</div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6 accomplishments-items">
                                                <p>1. <input type="text" class="form-control"></p>
                                                <p>2. <input type="text" class="form-control"></p>
                                                <p>3. <input type="text" class="form-control"></p>
                                            </div>
                                            <div class="col-lg-6 accomplishments-items">
                                                <p>4. <input type="text" class="form-control"></p>
                                                <p>5. <input type="text" class="form-control"></p>
                                                <p>6. <input type="text" class="form-control"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-4 mb-2 mb-lg-0">
                                <div class="card">
                                    <div class="card-header">Сегодня награждаются за примерное поведение</div>
                                    <div class="card-body">
                                        <input type="text" class="form-control">
                                        <input type="text" class="form-control mt-1">
                                        <input type="text" class="form-control mt-1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 mb-2 mb-lg-0">
                                <div class="card">
                                    <div class="card-header">Сегодня наказываются за пакости</div>
                                    <div class="card-body">
                                        <input type="text" class="form-control">
                                        <input type="text" class="form-control mt-1">
                                        <input type="text" class="form-control mt-1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-header">А этих мы просто игнорируем</div>
                                    <div class="card-body">
                                        <input type="text" class="form-control">
                                        <input type="text" class="form-control mt-1">
                                        <input type="text" class="form-control mt-1">
                                    </div>
                                </div>
                            </div>
                        </div>
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
                    <div class="tab-pane fade" id="v-pills-thoughts" role="tabpanel" aria-labelledby="v-pills-thoughts-tab">
                        <div class="row">
                            <div class="col-6">
                                <new-note></new-note>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-cit" role="tabpanel" aria-labelledby="v-pills-cit-tab">

                    </div>
                    <div class="tab-pane fade" id="v-pills-achievements" role="tabpanel" aria-labelledby="v-pills-achievements-tab">

                    </div>
                    <div class="tab-pane fade" id="v-pills-tasks" role="tabpanel" aria-labelledby="v-pills-tasks-tab">
                        <div class="row tasks">
                            <div class="col-12">
                                <tasks items= <?= json_encode($tasks) ?>></tasks>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-books" role="tabpanel" aria-labelledby="v-pills-books-tab">
                        <div class="row">
                            <div class="col-6">
                                <new-file></new-file>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-links" role="tabpanel" aria-labelledby="v-pills-links-tab">

                    </div>
                    <div class="tab-pane fade" id="v-pills-wishlist" role="tabpanel" aria-labelledby="v-pills-wishlist-tab">

                    </div>
                    <div class="tab-pane fade" id="v-pills-docs" role="tabpanel" aria-labelledby="v-pills-docs-tab">

                    </div>
                    <div class="tab-pane fade" id="v-pills-red" role="tabpanel" aria-labelledby="v-pills-red-tab">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
