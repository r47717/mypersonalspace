@extends('layouts.home')

@section('page-content')
    <div class="mb-3">
        <a class="btn btn-small {{ $filter === 'all' ? 'btn-success' : 'btn-info' }} note-filter-btn" href="/notes">все</a>
        @foreach($types as $type => $data)
            <a class="btn btn-small {{ $type === $filter ? 'btn-success' : 'btn-info' }} note-filter-btn" href="/notes?type={{ $type }}">{{ $data[1] }}</a>
        @endforeach
    </div>
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
        <textarea class="form-control mb-1" placeholder="Новая заметка" name="newNote" id="new-note-text"></textarea>
        <select name="type" class="form-control">
            @foreach($types as $type => $data)
                <option value="{{ $type }}">{{ $data[0] }}</option>
            @endforeach
        </select>
        <button class="btn btn-info mt-1" id="new-note-button" type="submit" disabled="true">Добавить</button>
    </form>
    <new-note></new-note>
@endsection
