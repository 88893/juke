@extends('layouts.app')

@section('title', 'Alle Liedjes')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h1 class="text-center jukebox-title">
            <i class="fas fa-music me-2"></i>Kies een Liedje
        </h1>
        <p class="text-center text-muted mb-4">Selecteer een liedje om af te spelen op de jukebox</p>

        @auth
        @if(auth()->user()->isAdmin())
        <div class="text-center mb-4">
            <a href="{{ route('songs.create') }}" class="btn btn-success">
                <i class="fas fa-plus-circle me-1"></i> Nieuw Liedje Toevoegen
            </a>
        </div>
        @endif
        @endauth
    </div>
</div>

<div class="row">
    @forelse($songs as $song)
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <img src="{{ asset($song->image_path) }}" class="card-img-top song-image" alt="{{ $song->title }}">
            <div class="card-body">
                <h5 class="card-title">{{ $song->title }}</h5>
                <p class="card-text">{{ $song->artist }}</p>
                <p class="text-muted">
                    <small><i class="fas fa-play me-1"></i> {{ $song->play_count }} keer afgespeeld</small>
                </p>
                <div class="d-grid gap-2">
                    <a href="{{ route('songs.show', $song) }}" class="btn btn-primary">
                        <i class="fas fa-play-circle me-1"></i> Afspelen
                    </a>

                    @auth
                    @if(auth()->user()->isAdmin())
                    <a href="{{ route('songs.edit', $song) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-1"></i> Bewerken
                    </a>
                    <form action="{{ route('songs.destroy', $song) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je dit liedje wilt verwijderen?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="fas fa-trash-alt me-1"></i> Verwijderen
                        </button>
                    </form>
                    @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center">
        <div class="alert alert-info">
            <p>Er zijn nog geen liedjes toegevoegd.</p>
            @auth
            @if(auth()->user()->isAdmin())
            <a href="{{ route('songs.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle me-1"></i> Voeg een liedje toe
            </a>
            @else
            <p>Een administrator moet eerst liedjes toevoegen.</p>
            @endif
            @else
            <p>Een administrator moet eerst liedjes toevoegen.</p>
            @endauth
        </div>
    </div>
    @endforelse
</div>
@endsection