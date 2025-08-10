@extends('layouts.app')

@section('title', $series->title . ' - SHOW.TV')

@section('content')
<div class="row">
    <div class="col-md-4">
        @if($series->thumbnail)
        <img src="{{ asset('storage/' . $series->thumbnail) }}" class="img-fluid rounded" style="width: 100%;">
        @else
        <div class="bg-secondary d-flex align-items-center justify-content-center rounded" style="height: 400px;">
            <i class="fas fa-tv fa-5x text-white"></i>
        </div>
        @endif
    </div>
    <div class="col-md-8">
        <h1>{{ $series->title }}</h1>
        <p class="lead">{{ $series->description }}</p>
        
        <div class="mb-3">
            <strong><i class="fas fa-clock"></i> Show Time:</strong> {{ $series->show_time }}
        </div>
        
        <div class="mb-3">
            <strong><i class="fas fa-film"></i> Episodes:</strong> {{ $series->episodes->count() }}
        </div>
        
        <div class="mb-4">
            @if($isFollowing)
            <form method="POST" action="{{ route('series.unfollow', $series) }}" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">
                    <i class="fas fa-heart-broken"></i> Unfollow
                </button>
            </form>
            @else
            <form method="POST" action="{{ route('series.follow', $series) }}" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-heart"></i> Follow
                </button>
            </form>
            @endif
        </div>
    </div>
</div>

<hr class="my-5">

<h3>Episodes</h3>
<div class="row">
    @forelse($series->episodes as $episode)
    <div class="col-md-6 mb-4">
        <div class="card episode-card">
            <div class="row g-0">
                <div class="col-4">
                    @if($episode->thumbnail)
                    <img src="{{ asset('storage/' . $episode->thumbnail) }}" class="img-fluid rounded-start" style="height: 120px; width: 100%; object-fit: cover;">
                    @else
                    <div class="bg-secondary d-flex align-items-center justify-content-center rounded-start" style="height: 120px;">
                        <i class="fas fa-play-circle fa-2x text-white"></i>
                    </div>
                    @endif
                </div>
                <div class="col-8">
                    <div class="card-body">
                        <h6 class="card-title">{{ $episode->title }}</h6>
                        <p class="card-text small">{{ Str::limit($episode->description, 60) }}</p>
                        <small class="text-muted d-block">{{ $episode->duration }} min</small>
                        <small class="text-muted d-block mb-2">{{ $episode->airing_time }}</small>
                        <a href="{{ route('episodes.show', $episode) }}" class="btn btn-sm btn-success">
                            <i class="fas fa-play"></i> Watch
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="alert alert-info text-center">
            <p>No episodes available for this series yet.</p>
        </div>
    </div>
    @endforelse
</div>
@endsection
