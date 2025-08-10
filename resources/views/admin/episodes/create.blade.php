@extends('layouts.app')

@section('title', 'Add New Episode - Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Add New Episode</h2>
    <a href="{{ route('admin.episodes.index') }}" class="btn btn-secondary">Back to Episodes</a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.episodes.store') }}" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <label for="series_id" class="form-label">Series</label>
                <select class="form-select @error('series_id') is-invalid @enderror" id="series_id" name="series_id" required>
                    <option value="">Select a series</option>
                    @foreach($series as $show)
                    <option value="{{ $show->id }}" {{ old('series_id', request('series_id')) == $show->id ? 'selected' : '' }}>
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
                       id="title" name="title" value="{{ old('title') }}" required>
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" 
                          id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="duration" class="form-label">Duration (minutes)</label>
                        <input type="number" class="form-control @error('duration') is-invalid @enderror" 
                               id="duration" name="duration" value="{{ old('duration') }}" min="1" required>
                        @error('duration')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="airing_time" class="form-label">Airing Time</label>
                        <input type="text" class="form-control @error('airing_time') is-invalid @enderror" 
                               id="airing_time" name="airing_time" value="{{ old('airing_time') }}" 
                               placeholder="e.g., Monday @ 8:30 PM" required>
                        @error('airing_time')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="thumbnail" class="form-label">Thumbnail Image</label>
                <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" 
                       id="thumbnail" name="thumbnail" accept="image/*">
                @error('thumbnail')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">Upload a thumbnail image for the episode (optional).</div>
            </div>
            
            <div class="mb-3">
                <label for="video_asset" class="form-label">Video File</label>
                <input type="file" class="form-control @error('video_asset') is-invalid @enderror" 
                       id="video_asset" name="video_asset" accept="video/*">
                @error('video_asset')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">Upload the video file for this episode (optional). Max size: 100MB.</div>
            </div>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Create Episode
                </button>
                <a href="{{ route('admin.episodes.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
