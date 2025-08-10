@extends('layouts.app')

@section('title', 'Episode Details - Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Episode Details</h2>
    <div>
        <a href="{{ route('admin.episodes.edit', $episode) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Edit Episode
        </a>
        <a href="{{ route('admin.episodes.index') }}" class="btn btn-secondary">Back to Episodes</a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        @if($episode->video_asset)
        <div class="video-container mb-3">
            <video controls class="w-100 rounded">
                <source src="{{ asset('storage/' . $episode->video_asset) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        @else
        <div class="bg-secondary d-flex align-items-center justify-content-center rounded mb-3" style="height: 300px;">
            <div class="text-center text-white">
                <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
                <h4>No Video Available</h4>
                <p>This episode doesn't have a video file yet.</p>
            </div>
        </div>
        @endif
        
        <div class="card">
            <div class="card-header">
                <h5>Episode Information</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="25%">Title:</th>
                        <td>{{ $episode->title }}</td>
                    </tr>
                    <tr>
                        <th>Description:</th>
                        <td>{{ $episode->description }}</td>
                    </tr>
                    <tr>
                        <th>Series:</th>
                        <td>
                            <a href="{{ route('admin.series.show', $episode->series) }}" class="text-decoration-none">
                                {{ $episode->series->title }}
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th>Duration:</th>
                        <td>{{ $episode->duration }} minutes</td>
                    </tr>
                    <tr>
                        <th>Airing Time:</th>
                        <td>{{ $episode->airing_time }}</td>
                    </tr>
                    <tr>
                        <th>Likes:</th>
                        <td>
                            <span class="badge bg-success">{{ $episode->likesCount() }} likes</span>
                            <span class="badge bg-danger">{{ $episode->dislikesCount() }} dislikes</span>
                        </td>
                    </tr>
                    <tr>
                        <th>Created:</th>
                        <td>{{ $episode->created_at->format('M d, Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Last Updated:</th>
                        <td>{{ $episode->updated_at->format('M d, Y H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        @if($episode->thumbnail)
        <div class="card mb-3">
            <div class="card-header">
                <h6>Thumbnail</h6>
            </div>
            <div class="card-body text-center">
                <img src="{{ asset('storage/' . $episode->thumbnail) }}" class="img-fluid rounded">
            </div>
        </div>
        @endif
        
        <div class="card">
            <div class="card-header">
                <h6>Series Information</h6>
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
                <div class="mb-3">
                    <small class="text-muted">
                        <i class="fas fa-film"></i> {{ $episode->series->episodes->count() }} episodes
                    </small>
                </div>
                <a href="{{ route('admin.series.show', $episode->series) }}" class="btn btn-primary btn-sm w-100">
                    View Series
                </a>
            </div>
        </div>
        
        @if($episode->likes->count() > 0)
        <div class="card mt-3">
            <div class="card-header">
                <h6>Recent Likes & Dislikes</h6>
            </div>
            <div class="card-body">
                @foreach($episode->likes->take(5) as $like)
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <small>{{ $like->user->name }}</small>
                    <span class="badge {{ $like->is_like ? 'bg-success' : 'bg-danger' }}">
                        {{ $like->is_like ? 'Like' : 'Dislike' }}
                    </span>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
