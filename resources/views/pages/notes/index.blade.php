@extends('layouts.home')

@section('page-content')
    <div class="mb-5">
        @foreach($notes as $item)
            <div class="card mb-2">
                <div class="card-body note-box">
                    <form action="/notes/update" method="post">
                        @csrf
                        <textarea class="form-control" name="newText">{{ $item->text }}</textarea>
                        <input type="hidden" name="id" value="{{ $item->id }}}">
                        <button type="submit" class="update">&#9745;</button>
                    </form>
                    <form action="/notes/delete" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $item->id }}}">
                        <button type="submit" class="close">&times;</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
    <form action="/notes" method="post">
        @csrf
        <textarea class="form-control mb-1" placeholder="Новая заметка" name="newNote"></textarea>
        <button class="btn btn-info mt-1" type="submit">Добавить</button>
    </form>
@endsection
