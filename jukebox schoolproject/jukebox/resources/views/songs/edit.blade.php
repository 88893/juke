@extends('layouts.app')

@section('title', 'Liedje Bewerken - ' . $song->title)

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-dark">
                    <h2 class="text-center mb-0">
                        <i class="fas fa-edit me-2"></i>Liedje Bewerken
                    </h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('songs.update', $song) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="title" class="form-label">Titel</label>
                            <input type="text" class="form-control bg-dark text-light @error('title') is-invalid @enderror" 
                                id="title" name="title" value="{{ old('title', $song->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="artist" class="form-label">Artiest</label>
                            <input type="text" class="form-control bg-dark text-light @error('artist') is-invalid @enderror" 
                                id="artist" name="artist" value="{{ old('artist', $song->artist) }}" required>
                            @error('artist')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <label for="music_file" class="form-label">Muziekbestand (MP3, WAV, OGG)</label>
                                <input type="file" class="form-control bg-dark text-light @error('music_file') is-invalid @enderror" 
                                    id="music_file" name="music_file" accept=".mp3,.wav,.ogg">
                                @error('music_file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Maximum bestandsgrootte: 10MB. Laat leeg om huidige bestand te behouden.</small>
                            </div>
                            <div class="col-md-4">
                                <div class="mt-4">
                                    <audio controls class="w-100">
                                        <source src="{{ asset($song->file_path) }}" type="audio/mpeg">
                                        Je browser ondersteunt geen audio element.
                                    </audio>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <label for="image_file" class="form-label">Albumhoes (JPEG, PNG, JPG)</label>
                                <input type="file" class="form-control bg-dark text-light @error('image_file') is-invalid @enderror" 
                                    id="image_file" name="image_file" accept=".jpeg,.jpg,.png">
                                @error('image_file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Maximum bestandsgrootte: 2MB. Laat leeg om huidige afbeelding te behouden.</small>
                            </div>
                            <div class="col-md-4">
                                <div class="mt-4">
                                    <img src="{{ asset($song->image_path) }}" alt="{{ $song->title }}" class="img-thumbnail" style="max-height: 100px;">
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-between">
                            <a href="{{ route('songs.show', $song) }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Terug
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Opslaan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection 