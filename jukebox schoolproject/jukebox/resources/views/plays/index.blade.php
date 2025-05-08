@extends('layouts.app')

@section('title', 'Afspeelgeschiedenis')

@section('content')
    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="text-center jukebox-title">
                <i class="fas fa-history me-2"></i>Afspeelgeschiedenis
            </h1>
            <p class="text-center text-muted mb-4">Een overzicht van alle afgespeelde liedjes in chronologische volgorde</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card">
                <div class="card-header bg-dark">
                    <h4 class="mb-0">
                        <i class="fas fa-clock me-2"></i>Afspeeloverzicht
                    </h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-dark table-striped table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Datum & Tijd</th>
                                    <th>Afbeelding</th>
                                    <th>Liedje</th>
                                    <th>Artiest</th>
                                    <th>Acties</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($plays as $play)
                                    <tr>
                                        <td>{{ $play->played_at->format('d-m-Y H:i:s') }}</td>
                                        <td>
                                            <img src="{{ asset($play->song->image_path) }}" alt="{{ $play->song->title }}" 
                                                 class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                        </td>
                                        <td>{{ $play->song->title }}</td>
                                        <td>{{ $play->song->artist }}</td>
                                        <td>
                                            <a href="{{ route('songs.show', $play->song) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-play"></i> Opnieuw Afspelen
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Geen afspeelgeschiedenis gevonden.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 