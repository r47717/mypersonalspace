@extends('layouts.home')

@section('page-content')
    <div class="mb-5">
        @foreach($cits as $cit)
        <div class="card mt-2">
            <div class="card-body link-box">
                <?= $cit['cit'] ?><?= !empty($cit['author']) ? " (" . $cit['author'] .")" : ""?>
                <form action="/cit/delete/<?= $cit['id'] ?>" method="post">
                    @csrf
                    <button type="submit">X</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    <form action="/cit/new" method="post">
        @csrf
        <input type="text" class="form-control mb-1" placeholder="Новая цитата" name="newCit">
        <input type="text" class="form-control" placeholder="Автор" name="author">
        <button class="btn btn-info mt-1" type="submit">Добавить</button>
    </form>
@endsection
