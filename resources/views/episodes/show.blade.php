@extends('layouts.app')

@section('title', $episode->title . ' - SHOW.TV')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="video-container mb-3">
            @if($episode->video_asset)
            <video controls class="w-100 rounded">
                <source src="{{ asset('storage/' . $episode->video_asset) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            @else
            <div class="bg-secondary d-flex align-items-center justify-content-center rounded" style="height: 400px;">
                <div class="text-center text-white">
                    <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
                    <h4>Video Not Available</h4>
                    <p>This episode's video is currently unavailable.</p>
                </div>
            </div>
            @endif
        </div>
        
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>{{ $episode->title }}</h2>
            <div>
                @if($userLike && $userLike->is_like)
                <form method="POST" action="{{ route('episodes.dislike', $episode) }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-outline-primary">
                        <i class="fas fa-thumbs-up"></i> {{ $episode->likesCount() }}
                    </button>
                </form>
                @else
                <form method="POST" action="{{ route('episodes.like', $episode) }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary">
                        <i class="far fa-thumbs-up"></i> {{ $episode->likesCount() }}
                    </button>
                </form>
                @endif
                
                @if($userLike && !$userLike->is_like)
                <form method="POST" action="{{ route('episodes.like', $episode) }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="fas fa-thumbs-down"></i> {{ $episode->dislikesCount() }}
                    </button>
                </form>
                @else
                <form method="POST" action="{{ route('episodes.dislike', $episode) }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary">
                        <i class="far fa-thumbs-down"></i> {{ $episode->dislikesCount() }}
                    </button>
                </form>
                @endif
            </div>
        </div>
        
        <p class="lead">{{ $episode->description }}</p>
        
        <div class="mb-3">
            <small class="text-muted">
                <i class="fas fa-clock"></i> Duration: {{ $episode->duration }} minutes
            </small>
        </div>
        
        <div class="mb-3">
            <small class="text-muted">
                <i class="fas fa-calendar"></i> Aired: {{ $episode->airing_time }}
            </small>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>Series Information</h5>
            </div>
            <div class="card-body">
                @if($episode->series->thumbnail)
                <img src="{{ asset('storage/' . $episode->series->thumbnail) }}" class="img-fluid rounded mb-3">
                @endif
                <h6>{{ $episode->series->title }}</h6>
                <p class="small">{{ Str::limit($episode->series->description, 100) }}</p>
                <div class="mb-2">
                    <small class="text-muted">
                        <i class="fas fa-clock"></i> {{ $episode->series->show_time }}
                    </small>
                </div>
                <a href="{{ route('series.show', $episode->series) }}" class="btn btn-primary btn-sm w-100">
                    View All Episodes
                </a>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h6>More Episodes</h6>
            </div>
            <div class="card-body">
                @forelse($episode->series->episodes->take(5) as $relatedEpisode)
                @if($relatedEpisode->id !== $episode->id)
                <div class="mb-2">
                    <a href="{{ route('episodes.show', $relatedEpisode) }}" class="text-decoration-none">
                        <div class="d-flex">
                            <div style="width: 60px; height: 40px;" class="me-2">
                                @if($relatedEpisode->thumbnail)
                                <img src="{{ asset('storage/' . $relatedEpisode->thumbnail) }}" class="img-fluid rounded" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                <div class="bg-secondary d-flex align-items-center justify-content-center rounded" style="width: 100%; height: 100%;">
                                    <i class="fas fa-play text-white"></i>
                                </div>
                                @endif
                            </div>
                            <div class="flex-grow-1">
                                <div class="small fw-bold">{{ Str::limit($relatedEpisode->title, 30) }}</div>
                                <div class="text-muted" style="font-size: 0.75rem;">{{ $relatedEpisode->duration }} min</div>
                            </div>
                        </div>
                    </a>
                </div>
                @endif
                @empty
                <p class="small text-muted">No other episodes available.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
