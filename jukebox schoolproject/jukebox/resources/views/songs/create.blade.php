@extends('layouts.app')

@section('title', 'Nieuw Liedje Toevoegen')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-dark">
                    <h2 class="text-center mb-0">
                        <i class="fas fa-plus-circle me-2"></i>Nieuw Liedje Toevoegen
                    </h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('songs.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="title" class="form-label">Titel</label>
                            <input type="text" class="form-control bg-dark text-light @error('title') is-invalid @enderror" 
                                id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="artist" class="form-label">Artiest</label>
                            <input type="text" class="form-control bg-dark text-light @error('artist') is-invalid @enderror" 
                                id="artist" name="artist" value="{{ old('artist') }}" required>
                            @error('artist')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="music_file" class="form-label">Muziekbestand (MP3, WAV, OGG)</label>
                            <input type="file" class="form-control bg-dark text-light @error('music_file') is-invalid @enderror" 
                                id="music_file" name="music_file" required accept=".mp3,.wav,.ogg">
                            @error('music_file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Maximum bestandsgrootte: 10MB</small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="image_file" class="form-label">Albumhoes (JPEG, PNG, JPG)</label>
                            <input type="file" class="form-control bg-dark text-light @error('image_file') is-invalid @enderror" 
                                id="image_file" name="image_file" required accept=".jpeg,.jpg,.png">
                            @error('image_file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Maximum bestandsgrootte: 2MB</small>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-between">
                            <a href="{{ route('songs.index') }}" class="btn btn-secondary">
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