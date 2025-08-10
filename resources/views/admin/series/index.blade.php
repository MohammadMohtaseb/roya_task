@extends('layouts.app')

@section('title', 'Manage Series - Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Manage TV Series</h2>
    <div>
        <a href="{{ route('admin.series.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Add New Series
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
                        <th>Show Time</th>
                        <th>Episodes</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($series as $show)
                    <tr>
                        <td>{{ $show->id }}</td>
                        <td>
                            @if($show->thumbnail)
                            <img src="{{ asset('storage/' . $show->thumbnail) }}" width="60" height="40" style="object-fit: cover;" class="rounded">
                            @else
                            <div class="bg-secondary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 40px;">
                                <i class="fas fa-tv text-white"></i>
                            </div>
                            @endif
                        </td>
                        <td>
                            <strong>{{ $show->title }}</strong>
                            <br>
                            <small class="text-muted">{{ Str::limit($show->description, 50) }}</small>
                        </td>
                        <td>{{ $show->show_time }}</td>
                        <td>
                            <span class="badge bg-info">{{ $show->episodes->count() }} episodes</span>
                        </td>
                        <td>{{ $show->created_at->format('M d, Y') }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.series.show', $show) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.series.edit', $show) }}" class="btn btn-sm btn-outline-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.series.destroy', $show) }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this series?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">No series found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@if($series->hasPages())
<div class="d-flex justify-content-center mt-4">
    {{ $series->links() }}
</div>
@endif
@endsection
