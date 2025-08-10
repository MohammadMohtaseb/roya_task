@extends('layouts.app')

@section('title', 'All Series - SHOW.TV')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>All TV Series</h2>
</div>

<div class="row">
    @forelse($series as $show)
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            @if($show->thumbnail)
            <img src="{{ asset('storage/' . $show->thumbnail) }}" class="card-img-top" style="height: 250px; object-fit: cover;">
            @else
            <div class="bg-secondary d-flex align-items-center justify-content-center" style="height: 250px;">
                <i class="fas fa-tv fa-4x text-white"></i>
            </div>
            @endif
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">{{ $show->title }}</h5>
                <p class="card-text flex-grow-1">{{ Str::limit($show->description, 120) }}</p>
                <div class="mt-auto">
                    <small class="text-muted d-block mb-2">
                        <i class="fas fa-clock"></i> {{ $show->show_time }}
                    </small>
                    <small class="text-muted d-block mb-3">
                        <i class="fas fa-film"></i> {{ $show->episodes->count() }} episodes
                    </small>
                    <a href="{{ route('series.show', $show) }}" class="btn btn-primary w-100">View Series</a>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="alert alert-info text-center">
            <h4>No TV Series Available</h4>
            <p>Check back later for new content!</p>
        </div>
    </div>
    @endforelse
</div>

@if($series->hasPages())
<div class="d-flex justify-content-center">
    {{ $series->links() }}
</div>
@endif
@endsection
