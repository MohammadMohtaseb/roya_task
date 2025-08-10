@extends('layouts.app')

@section('title', 'Add New Series - Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Add New TV Series</h2>
    <a href="{{ route('admin.series.index') }}" class="btn btn-secondary">Back to Series</a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.series.store') }}" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
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
            
            <div class="mb-3">
                <label for="show_time" class="form-label">Show Time</label>
                <input type="text" class="form-control @error('show_time') is-invalid @enderror" 
                       id="show_time" name="show_time" value="{{ old('show_time') }}" 
                       placeholder="e.g., Monday-Thursday @ 8:30PM" required>
                @error('show_time')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="thumbnail" class="form-label">Thumbnail Image</label>
                <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" 
                       id="thumbnail" name="thumbnail" accept="image/*">
                @error('thumbnail')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">Upload a thumbnail image for the series (optional).</div>
            </div>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Create Series
                </button>
                <a href="{{ route('admin.series.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
