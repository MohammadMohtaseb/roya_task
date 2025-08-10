@extends('layouts.app')

@section('title', 'Search Results - SHOW.TV')

@section('content')
<div class="mb-4">
    <h2>Search Results for "{{ $query }}"</h2>
</div>

@if($series->count() > 0)
<div class="mb-5">
    <h4>TV Series</h4>
    <div class="row">
        @foreach($series as $show)
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                @if($show->thumbnail)
                <img src="{{ asset('storage/' . $show->thumbnail) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                @else
                <div class="bg-secondary d-flex align-items-center justify-content-center" style="height: 200px;">
                    <i class="fas fa-tv fa-3x text-white"></i>
                </div>
                @endif
                <div class="card-body d-flex flex-column">
                    <h6 class="card-title">{{ $show->title }}</h6>
                    <p class="card-text flex-grow-1">{{ Str::limit($show->description, 80) }}</p>
                    <div class="mt-auto">
                        <small class="text-muted d-block mb-2">{{ $show->show_time }}</small>
                        <a href="{{ route('series.show', $show) }}" class="btn btn-primary btn-sm w-100">View Series</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    @if($series->hasPages())
    <div class="d-flex justify-content-center mb-4">
        {{ $series->appends(['q' => $query])->links() }}
    </div>
    @endif
</div>
@endif

@if($episodes->count() > 0)
<div class="mb-5">
    <h4>Episodes</h4>
    <div class="row">
        @foreach($episodes as $episode)
        <div class="col-md-6 mb-3">
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
                            <small class="text-muted d-block">{{ $episode->series->title }}</small>
                            <small class="text-muted d-block">{{ $episode->duration }} min • {{ $episode->airing_time }}</small>
                            <div class="mt-2">
                                <a href="{{ route('episodes.show', $episode) }}" class="btn btn-sm btn-success">
                                    <i class="fas fa-play"></i> Watch
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    @if($episodes->hasPages())
    <div class="d-flex justify-content-center">
        {{ $episodes->appends(['q' => $query])->links() }}
    </div>
    @endif
</div>
@endif

@if($series->count() == 0 && $episodes->count() == 0)
<div class="alert alert-info text-center">
    <h4>No Results Found</h4>
    <p>We couldn't find any series or episodes matching "{{ $query }}".</p>
    <a href="{{ route('series.index') }}" class="btn btn-primary">Browse All Series</a>
</div>
@endif
@endsection
