@extends('layouts.home')

@section('page-title')
    Мои игры
@endsection

@section('page-content')
    @foreach($games as $game)
        @if (!isset($game['enabled']) || $game['enabled'] === true)
            <a href="{{ route("games-" . $game['url'])  }}" class="game-widget-container">
                <div>
                    <h5>{{ $game["name"]  }}</h5>
                    <h7>Тип: {{ $game["type"]  }}</h7>
                    <img src="{{ \App\Models\GamesRegistry::gameThumbnailUrls[$game["type"]]  }}"
                         alt="{{ $game["type"]  }}">
                </div>
            </a>
        @endif
    @endforeach
@endsection
