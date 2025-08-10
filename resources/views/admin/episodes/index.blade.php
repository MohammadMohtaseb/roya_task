@extends('layouts.app')

@section('title', 'Manage Episodes - Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Manage Episodes</h2>
    <div>
        <a href="{{ route('admin.episodes.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Add New Episode
        </a>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Thumbnail</th>
                        <th>Title</th>
                        <th>Series</th>
                        <th>Duration</th>
                        <th>Airing Time</th>
                        <th>Likes</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($episodes as $episode)
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
                        <td>
                            <a href="{{ route('admin.series.show', $episode->series) }}" class="text-decoration-none">
                                {{ $episode->series->title }}
                            </a>
                        </td>
                        <td>{{ $episode->duration }} min</td>
                        <td>{{ $episode->airing_time }}</td>
                        <td>
                            <span class="badge bg-success">{{ $episode->likesCount() }}</span>
                            <span class="badge bg-danger">{{ $episode->dislikesCount() }}</span>
                        </td>
                        <td>{{ $episode->created_at->format('M d, Y') }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.episodes.show', $episode) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.episodes.edit', $episode) }}" class="btn btn-sm btn-outline-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.episodes.destroy', $episode) }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this episode?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center">No episodes found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@if($episodes->hasPages())
<div class="d-flex justify-content-center mt-4">
    {{ $episodes->links() }}
</div>
@endif
@endsection
