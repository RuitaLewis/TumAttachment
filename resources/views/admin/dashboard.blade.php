@extends('admin.layouts.app')

@php
    $totalusers = \App\Models\User::all()->count();
    $total_organizations= App\Models\Organization::all()->count();
    $total_attachments= App\Models\Attachment::all()->count();
    $total_attachment_applications= App\Models\AttachmentApplication::all()->count();
    $users = \App\Models\user::all();

@endphp
@section('content')
    <button class="menu-toggle">
        <i class="fas fa-bars"></i>
    </button>

    <div class="stats-grid">
        <div class="stat-card">
            <h3>Students</h3>
            <div class="stat-value">{{ $totalusers }}</div>
            <div class="stat-label">Total Registered Students</div>
        </div>
        <div class="stat-card">
            <h3>Organizations</h3>
            <div class="stat-value">{{ $total_organizations }}</div>
            <div class="stat-label">Total Registered Organizations</div>
        </div>
        <div class="stat-card">
            <h3>Attachment Postings</h3>
            <div class="stat-value">{{ $total_attachments }}</div>
            <div class="stat-label">Active Postings</div>
        </div>
        <div class="stat-card">
            <h3>Applications</h3>
            <div class="stat-value">{{ $total_attachment_applications }}</div>
            <div class="stat-label">Total Applications</div>
        </div>
    </div>



    <div class="profile-container">
        <h3>Users</h3>
        <table class="profile-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Attachment Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td><button>Edit</button> <button>Delete</button></td>
                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>
    </div>

@endsection
