@extends('layouts.app')

@section('title', 'Edit Series - Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit Series: {{ $series->title }}</h2>
    <div>
        <a href="{{ route('admin.series.show', $series) }}" class="btn btn-info">View Series</a>
        <a href="{{ route('admin.series.index') }}" class="btn btn-secondary">Back to Series</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.series.update', $series) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                       id="title" name="title" value="{{ old('title', $series->title) }}" required>
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" 
                          id="description" name="description" rows="4" required>{{ old('description', $series->description) }}</textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="show_time" class="form-label">Show Time</label>
                <input type="text" class="form-control @error('show_time') is-invalid @enderror" 
                       id="show_time" name="show_time" value="{{ old('show_time', $series->show_time) }}" 
                       placeholder="e.g., Monday-Thursday @ 8:30PM" required>
                @error('show_time')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="thumbnail" class="form-label">Thumbnail Image</label>
                @if($series->thumbnail)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $series->thumbnail) }}" width="200" class="rounded">
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
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning">
                    <i class="fas fa-save"></i> Update Series
                </button>
                <a href="{{ route('admin.series.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
