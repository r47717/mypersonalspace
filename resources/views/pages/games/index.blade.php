@extends('layouts.home')

@section('page-content')
    <h3 class="mb-4">Мои игры:</h3>
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
