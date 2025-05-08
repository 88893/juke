@extends('layouts.app')

@section('title', $song->title . ' - ' . $song->artist)

@section('content')
    <div class="row mb-4">
        <div class="col-lg-6">
            <div class="card playing-card mb-4">
                <div class="card-body text-center">
                    <img src="{{ asset($song->image_path) }}" alt="{{ $song->title }}" class="img-fluid rounded mb-3" style="max-height: 300px;">
                    <h2 class="card-title jukebox-title">{{ $song->title }}</h2>
                    <h4 class="text-muted">{{ $song->artist }}</h4>
                    <p class="text-light">
                        <i class="fas fa-play-circle me-1"></i> {{ $song->play_count }} keer afgespeeld
                    </p>
                    
                    <audio controls autoplay class="w-100 mb-3">
                        <source src="{{ asset($song->file_path) }}" type="audio/mpeg">
                        Je browser ondersteunt geen audio element.
                    </audio>
                    
                    <div class="d-flex justify-content-between mt-3">
                        <a href="{{ route('songs.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Terug naar liedjes
                        </a>
                        <a href="{{ route('songs.edit', $song) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-1"></i> Bewerken
                        </a>
                        <form action="{{ route('songs.destroy', $song) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je dit liedje wilt verwijderen?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash me-1"></i> Verwijderen
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header bg-dark">
                    <h4 class="mb-0">
                        <i class="fas fa-comments me-2"></i>Reviews
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('reviews.store', $song) }}" method="POST" class="mb-4">
                        @csrf
                        <div class="mb-3">
                            <label for="reviewer_name" class="form-label">Je naam (optioneel)</label>
                            <input type="text" class="form-control bg-dark text-light" id="reviewer_name" name="reviewer_name" placeholder="Anoniem">
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Je review</label>
                            <textarea class="form-control bg-dark text-light" id="content" name="content" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane me-1"></i> Plaats Review
                        </button>
                    </form>
                    
                    <hr>
                    
                    <div class="reviews-container">
                        @forelse($reviews as $review)
                            <div class="review-item mb-3 p-3 border border-secondary rounded">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h5 class="mb-0">{{ $review->reviewer_name }}</h5>
                                    <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="mb-0">{{ $review->content }}</p>
                                <form action="{{ route('reviews.destroy', $review) }}" method="POST" class="mt-2 text-end">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        @empty
                            <p class="text-center text-muted">Er zijn nog geen reviews voor dit liedje.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 