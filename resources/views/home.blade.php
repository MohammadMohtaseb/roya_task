@extends('layouts.app')

@section('title', 'Welcome to SHOW.TV')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="jumbotron bg-primary text-white rounded p-5 mb-4">
            <h1 class="display-4">Welcome to SHOW.TV</h1>
            <p class="lead">Your ultimate destination for streaming TV shows and series!</p>
            @guest
            <a class="btn btn-light btn-lg" href="{{ route('register') }}">Get Started</a>
            @endguest
        </div>
    </div>
</div>

@auth
<div class="row mb-4">
    <div class="col-md-6">
        <h3>Random Series</h3>
        <div class="row">
            @forelse($randomSeries as $series)
            <div class="col-md-6 mb-3">
                <div class="card">
                    @if($series->thumbnail)
                    <img src="{{ asset('storage/' . $series->thumbnail) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h6 class="card-title">{{ $series->title }}</h6>
                        <p class="card-text small">{{ Str::limit($series->description, 60) }}</p>
                        <small class="text-muted">{{ $series->show_time }}</small>
                        <div class="mt-2">
                            <a href="{{ route('series.show', $series) }}" class="btn btn-sm btn-primary">View</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <p>No series available.</p>
            @endforelse
        </div>
    </div>
    
    <div class="col-md-6">
        <h3>Latest Episodes</h3>
        @forelse($latestEpisodes as $episode)
        <div class="card mb-3 episode-card">
            <div class="row g-0">
                <div class="col-md-4">
                    @if($episode->thumbnail)
                    <img src="{{ asset('storage/' . $episode->thumbnail) }}" class="img-fluid rounded-start" style="height: 100%; object-fit: cover;">
                    @else
                    <div class="bg-secondary d-flex align-items-center justify-content-center" style="height: 100px;">
                        <i class="fas fa-play-circle fa-2x text-white"></i>
                    </div>
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h6 class="card-title">{{ $episode->title }}</h6>
                        <p class="card-text small">{{ Str::limit($episode->description, 80) }}</p>
                        <small class="text-muted">
                            {{ $episode->series->title }} • {{ $episode->duration }} min • {{ $episode->airing_time }}
                        </small>
                        <div class="mt-2">
                            <a href="{{ route('episodes.show', $episode) }}" class="btn btn-sm btn-success">
                                <i class="fas fa-play"></i> Watch
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <p>No episodes available.</p>
        @endforelse
    </div>
</div>
@endauth

@guest
<div class="row">
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <i class="fas fa-tv fa-3x text-primary mb-3"></i>
                <h5>Watch Your Favorite Shows</h5>
                <p>Access thousands of TV shows and series</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <i class="fas fa-heart fa-3x text-danger mb-3"></i>
                <h5>Like & Follow</h5>
                <p>Like episodes and follow your favorite series</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <i class="fas fa-search fa-3x text-success mb-3"></i>
                <h5>Easy Search</h5>
                <p>Find episodes and series quickly</p>
            </div>
        </div>
    </div>
</div>
@endguest
@endsection
