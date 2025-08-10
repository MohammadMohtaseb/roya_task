@extends('layouts.app')

@section('title', 'Admin Dashboard - SHOW.TV')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Admin Dashboard</h2>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="card text-center bg-primary text-white">
            <div class="card-body">
                <i class="fas fa-users fa-3x mb-3"></i>
                <h4>{{ \App\Models\User::count() }}</h4>
                <p>Total Users</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card text-center bg-success text-white">
            <div class="card-body">
                <i class="fas fa-tv fa-3x mb-3"></i>
                <h4>{{ \App\Models\Series::count() }}</h4>
                <p>Total Series</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card text-center bg-info text-white">
            <div class="card-body">
                <i class="fas fa-film fa-3x mb-3"></i>
                <h4>{{ \App\Models\Episode::count() }}</h4>
                <p>Total Episodes</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card text-center bg-warning text-white">
            <div class="card-body">
                <i class="fas fa-heart fa-3x mb-3"></i>
                <h4>{{ \App\Models\EpisodeLike::where('is_like', true)->count() }}</h4>
                <p>Total Likes</p>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.series.create') }}" class="btn btn-success">
                        <i class="fas fa-plus"></i> Add New Series
                    </a>
                    <a href="{{ route('admin.episodes.create') }}" class="btn btn-info">
                        <i class="fas fa-plus"></i> Add New Episode
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-primary">
                        <i class="fas fa-users"></i> Manage Users
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Management</h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <a href="{{ route('admin.series.index') }}" class="list-group-item list-group-item-action">
                        <i class="fas fa-tv"></i> Manage Series
                        <span class="badge bg-primary rounded-pill float-end">{{ \App\Models\Series::count() }}</span>
                    </a>
                    <a href="{{ route('admin.episodes.index') }}" class="list-group-item list-group-item-action">
                        <i class="fas fa-film"></i> Manage Episodes
                        <span class="badge bg-info rounded-pill float-end">{{ \App\Models\Episode::count() }}</span>
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action">
                        <i class="fas fa-users"></i> View Users
                        <span class="badge bg-success rounded-pill float-end">{{ \App\Models\User::count() }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
