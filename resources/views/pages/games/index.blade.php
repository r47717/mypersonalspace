@extends('layouts.home')

@section('page-content')
    <h3>Доступные игры:</h3>
    <div class="bg-light p-1 rounded"><a href="{{ route('games-tetris')  }}">Тетрис</a></div>
    <div class="bg-light p-1 rounded mt-1"><a href="{{ route('games-star-wars')  }}">Звёздные войны</a></div>
@endsection
