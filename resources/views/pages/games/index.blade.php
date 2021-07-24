@extends('layouts.home')

@section('page-title')
    Мои игры
@endsection

@section('page-content')
    @foreach($games as $game)
        <a href="{{ route('games-tetris')  }}" class="game-widget-container">
            <div>
                <h5>{{ $game["name"]  }}</h5>
                <h7>Тип: {{ $game["type"]  }}</h7>
                <img src="{{ $game["imageUrl"]  }}" alt="{{ $game["type"]  }}">
            </div>
        </a>
    @endforeach
@endsection
