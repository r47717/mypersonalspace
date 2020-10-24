@extends('layouts.home')

@section('page-content')
    <div class="mb-5">
        @foreach($links as $link)
        <div class="card mt-2">
            <div class="card-body link-box">
                <a href="<?= $link['link'] ?>" target="_blank">
                    <?= $link['link'] ?><?= !empty($link['comment']) ? " (" . $link['comment'] .")" : ""?>
                </a>
                <form action="/links/delete/<?= $link['id'] ?>" method="post">
                    @csrf
                    <button type="submit">X</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    <form action="/links/new" method="post">
        @csrf
        <input type="text" class="form-control mb-1" placeholder="Новая ссылка" name="newLink">
        <input type="text" class="form-control" placeholder="Что это?" name="comment">
        <button class="btn btn-info mt-1" type="submit">Добавить</button>
    </form>
@endsection
