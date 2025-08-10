@extends('layouts.app')

@section('title', 'Edit Episode - Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit Episode: {{ $episode->title }}</h2>
    <div>
        <a href="{{ route('admin.episodes.show', $episode) }}" class="btn btn-info">View Episode</a>
        <a href="{{ route('admin.episodes.index') }}" class="btn btn-secondary">Back to Episodes</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.episodes.update', $episode) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="series_id" class="form-label">Series</label>
                <select class="form-select @error('series_id') is-invalid @enderror" id="series_id" name="series_id" required>
                    <option value="">Select a series</option>
                    @foreach($series as $show)
                    <option value="{{ $show->id }}" {{ old('series_id', $episode->series_id) == $show->id ? 'selected' : '' }}>
                        {{ $show->title }}
                    </option>
                    @endforeach
                </select>
                @error('series_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="title" class="form-label">Episode Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                       id="title" name="title" value="{{ old('title', $episode->title) }}" required>
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" 
                          id="description" name="description" rows="4" required>{{ old('description', $episode->description) }}</textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="duration" class="form-label">Duration (minutes)</label>
                        <input type="number" class="form-control @error('duration') is-invalid @enderror" 
                               id="duration" name="duration" value="{{ old('duration', $episode->duration) }}" min="1" required>
                        @error('duration')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="airing_time" class="form-label">Airing Time</label>
                        <input type="text" class="form-control @error('airing_time') is-invalid @enderror" 
                               id="airing_time" name="airing_time" value="{{ old('airing_time', $episode->airing_time) }}" 
                               placeholder="e.g., Monday @ 8:30 PM" required>
                        @error('airing_time')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="thumbnail" class="form-label">Thumbnail Image</label>
                @if($episode->thumbnail)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $episode->thumbnail) }}" width="200" class="rounded">
                    <p class="text-muted small">Current thumbnail</p>
                </div>
                @endif
                <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" 
                       id="thumbnail" name="thumbnail" accept="image/*">
                @error('thumbnail')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">Upload a new thumbnail image (optional). Leave empty to keep current image.</div>
            </div>
            
            <div class="mb-3">
                <label for="video_asset" class="form-label">Video File</label>
                @if($episode->video_asset)
                <div class="mb-2">
                    <video width="300" controls class="rounded">
                        <source src="{{ asset('storage/' . $episode->video_asset) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <p class="text-muted small">Current video</p>
                </div>
                @endif
                <input type="file" class="form-control @error('video_asset') is-invalid @enderror" 
                       id="video_asset" name="video_asset" accept="video/*">
                @error('video_asset')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">Upload a new video file (optional). Leave empty to keep current video. Max size: 100MB.</div>
            </div>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning">
                    <i class="fas fa-save"></i> Update Episode
                </button>
                <a href="{{ route('admin.episodes.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
