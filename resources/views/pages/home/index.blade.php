@extends('layouts.home')

@section('page-content')
    <div>
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
                    <div class="card-header">Идея дня</div>
                    <div class="card-body">
                        <textarea name="brilliant-idea" class="form-control w-100 h-100"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card accomplishments">
                    <div class="card-header acc-header">
                        <div>Достижения</div>
                        <button class="btn btn-sm btn-success">Очистить</button>
                    </div>
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
            <div class="col-lg-5 mb-2 mb-lg-0 offset-1">
                <div class="card">
                    <div class="card-header">Сегодня награждаются за примерное поведение</div>
                    <div class="card-body">
                        <input type="text" class="form-control">
                        <input type="text" class="form-control mt-1">
                        <input type="text" class="form-control mt-1">
                    </div>
                </div>
            </div>
            <div class="col-lg-5 mb-2 mb-lg-0">
                <div class="card">
                    <div class="card-header">Сегодня наказываются за пакости</div>
                    <div class="card-body">
                        <input type="text" class="form-control">
                        <input type="text" class="form-control mt-1">
                        <input type="text" class="form-control mt-1">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
