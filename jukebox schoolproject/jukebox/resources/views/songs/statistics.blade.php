@extends('layouts.app')

@section('title', 'Jukebox Statistieken')

@section('content')
    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="text-center jukebox-title">
                <i class="fas fa-chart-bar me-2"></i>Jukebox Statistieken
            </h1>
            <p class="text-center text-muted mb-4">Een overzicht van hoe vaak elk liedje is afgespeeld</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <h4 class="mb-0">
                        <i class="fas fa-music me-2"></i>Liedjes Gesorteerd op Populariteit
                    </h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-dark table-striped table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Afbeelding</th>
                                    <th>Titel</th>
                                    <th>Artiest</th>
                                    <th>Aantal keer afgespeeld</th>
                                    <th>Acties</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($songs as $index => $song)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <img src="{{ asset($song->image_path) }}" alt="{{ $song->title }}" 
                                                 class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                        </td>
                                        <td>{{ $song->title }}</td>
                                        <td>{{ $song->artist }}</td>
                                        <td>
                                            <span class="badge bg-primary">
                                                <i class="fas fa-play me-1"></i> {{ $song->play_count }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('songs.show', $song) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-play"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Geen liedjes gevonden.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(count($songs) > 0)
        <div class="row mt-4">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header bg-dark">
                        <h4 class="mb-0">
                            <i class="fas fa-chart-pie me-2"></i>Visuele Weergave
                        </h4>
                    </div>
                    <div class="card-body">
                        <canvas id="songChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('scripts')
    @if(count($songs) > 0)
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const ctx = document.getElementById('songChart').getContext('2d');
                
                const songTitles = [
                    @foreach($songs as $song)
                        '{{ $song->title }} - {{ $song->artist }}',
                    @endforeach
                ];
                
                const playCountData = [
                    @foreach($songs as $song)
                        {{ $song->play_count }},
                    @endforeach
                ];
                
                const songChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: songTitles,
                        datasets: [{
                            label: 'Aantal keer afgespeeld',
                            data: playCountData,
                            backgroundColor: [
                                '#e74c3c', '#3498db', '#2ecc71', '#f39c12', '#9b59b6',
                                '#1abc9c', '#d35400', '#c0392b', '#16a085', '#2980b9'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1
                                }
                            }
                        }
                    }
                });
            });
        </script>
    @endif
@endsection 