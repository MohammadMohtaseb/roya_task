@extends('layouts.app')

@section('title', 'Series Details - Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Series Details</h2>
    <div>
        <a href="{{ route('admin.series.edit', $series) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Edit Series
        </a>
        <a href="{{ route('admin.series.index') }}" class="btn btn-secondary">Back to Series</a>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        @if($series->thumbnail)
        <img src="{{ asset('storage/' . $series->thumbnail) }}" class="img-fluid rounded">
        @else
        <div class="bg-secondary d-flex align-items-center justify-content-center rounded" style="height: 300px;">
            <i class="fas fa-tv fa-5x text-white"></i>
        </div>
        @endif
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>Series Information</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="25%">Title:</th>
                        <td>{{ $series->title }}</td>
                    </tr>
                    <tr>
                        <th>Description:</th>
                        <td>{{ $series->description }}</td>
                    </tr>
                    <tr>
                        <th>Show Time:</th>
                        <td>{{ $series->show_time }}</td>
                    </tr>
                    <tr>
                        <th>Episodes:</th>
                        <td>
                            <span class="badge bg-info">{{ $series->episodes->count() }} episodes</span>
                        </td>
                    </tr>
                    <tr>
                        <th>Followers:</th>
                        <td>
                            <span class="badge bg-success">{{ $series->followers->count() }} followers</span>
                        </td>
                    </tr>
                    <tr>
                        <th>Created:</th>
                        <td>{{ $series->created_at->format('M d, Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Last Updated:</th>
                        <td>{{ $series->updated_at->format('M d, Y H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Episodes</h5>
                <a href="{{ route('admin.episodes.create') }}?series_id={{ $series->id }}" class="btn btn-success btn-sm">
                    <i class="fas fa-plus"></i> Add Episode
                </a>
            </div>
            <div class="card-body">
                @if($series->episodes->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Thumbnail</th>
                                <th>Title</th>
                                <th>Duration</th>
                                <th>Airing Time</th>
                                <th>Likes</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($series->episodes as $episode)
                            <tr>
                                <td>{{ $episode->id }}</td>
                                <td>
                                    @if($episode->thumbnail)
                                    <img src="{{ asset('storage/' . $episode->thumbnail) }}" width="60" height="40" style="object-fit: cover;" class="rounded">
                                    @else
                                    <div class="bg-secondary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 40px;">
                                        <i class="fas fa-play text-white"></i>
                                    </div>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $episode->title }}</strong>
                                    <br>
                                    <small class="text-muted">{{ Str::limit($episode->description, 40) }}</small>
                                </td>
                                <td>{{ $episode->duration }} min</td>
                                <td>{{ $episode->airing_time }}</td>
                                <td>
                                    <span class="badge bg-success">{{ $episode->likesCount() }} likes</span>
                                    <span class="badge bg-danger">{{ $episode->dislikesCount() }} dislikes</span>
                                </td>
                                <td>{{ $episode->created_at->format('M d') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.episodes.show', $episode) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.episodes.edit', $episode) }}" class="btn btn-sm btn-outline-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center text-muted">
                    <i class="fas fa-film fa-3x mb-3"></i>
                    <h5>No Episodes Yet</h5>
                    <p>This series doesn't have any episodes yet.</p>
                    <a href="{{ route('admin.episodes.create') }}?series_id={{ $series->id }}" class="btn btn-success">
                        <i class="fas fa-plus"></i> Add First Episode
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
