@extends('layouts.app')

@section('title', 'User Details - Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>User Details</h2>
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Back to Users</a>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                @if($user->user_image)
                <img src="{{ asset('storage/' . $user->user_image) }}" class="rounded-circle mb-3" width="150" height="150" style="object-fit: cover;">
                @else
                <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 150px; height: 150px;">
                    <i class="fas fa-user fa-4x text-white"></i>
                </div>
                @endif
                <h4>{{ $user->name }}</h4>
                <p class="text-muted">{{ $user->email }}</p>
                <span class="badge {{ $user->role === 'admin' ? 'bg-danger' : 'bg-primary' }} fs-6">
                    {{ ucfirst($user->role) }}
                </span>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>User Information</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="30%">User ID:</th>
                        <td>{{ $user->id }}</td>
                    </tr>
                    <tr>
                        <th>Name:</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>Role:</th>
                        <td>
                            <span class="badge {{ $user->role === 'admin' ? 'bg-danger' : 'bg-primary' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Email Verified:</th>
                        <td>
                            @if($user->email_verified_at)
                            <span class="badge bg-success">Verified</span>
                            <small class="text-muted">({{ $user->email_verified_at->format('M d, Y H:i') }})</small>
                            @else
                            <span class="badge bg-warning">Not Verified</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Joined:</th>
                        <td>{{ $user->created_at->format('M d, Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Last Updated:</th>
                        <td>{{ $user->updated_at->format('M d, Y H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h5>Activity Statistics</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="text-center">
                            <h4 class="text-primary">{{ $user->followedSeries->count() }}</h4>
                            <p class="mb-0">Followed Series</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center">
                            <h4 class="text-success">{{ $user->episodeLikes->where('is_like', true)->count() }}</h4>
                            <p class="mb-0">Liked Episodes</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center">
                            <h4 class="text-danger">{{ $user->episodeLikes->where('is_like', false)->count() }}</h4>
                            <p class="mb-0">Disliked Episodes</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
