@extends('admin.layouts.app')

@section('title', 'Student Profile')

@section('styles')
    <link rel="stylesheet" href="assets/css/student-profile.css">
@endsection

@php
    $user = \App\Models\User::findOrFail($id ?? request()->route('id'));
@endphp

@section('content')
    <button class="menu-toggle">
        <i class="fas fa-bars"></i>
    </button>

    <div class="profile-header">
        <h1>Student Profile</h1>
        <div class="profile-actions">
            <a href="{{ url('student-profile.edit', $user->id) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit Profile
            </a>
        </div>
    </div>

    <div class="profile-container">
        <div class="profile-summary">
            <div class="profile-avatar">
                @if ($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}">
                @else
                    <div class="avatar-placeholder">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                @endif
            </div>
            <div class="profile-info">
                <h2>{{ $user->name }}</h2>
                <p class="profile-email">{{ $user->email }}</p>
                <p class="profile-status">
                    <span class="status-badge {{ $user->status ?? 'active' }}">
                        {{ ucfirst($user->status ?? 'Active') }}
                    </span>
                </p>
            </div>
        </div>

        <div class="profile-details-grid">
            @include('student.src.profile.partials.personal-information')
            @include('student.src.profile.partials.academic-info')


        </div>

        <div class="detail-card">
            <h3>Attachment Status</h3>
            <div class="Attachment-status">
                @if (isset($user->Attachment) && $user->Attachment)
                    <div class="status-details">
                        <p><strong>Organization:</strong> {{ $user->Attachment->organization->name ?? 'N/A' }}</p>
                        <p><strong>Position:</strong> {{ $user->Attachment->position ?? 'N/A' }}</p>
                        <p><strong>Start Date:</strong>
                            {{ $user->Attachment->start_date ? date('F d, Y', strtotime($user->Attachment->start_date)) : 'N/A' }}
                        </p>
                        <p><strong>End Date:</strong>
                            {{ $user->Attachment->end_date ? date('F d, Y', strtotime($user->Attachment->end_date)) : 'N/A' }}
                        </p>
                        <p><strong>Status:</strong> <span
                                class="badge badge-{{ $user->Attachment->status === 'active' ? 'success' : ($user->Attachment->status === 'pending' ? 'warning' : 'secondary') }}">{{ ucfirst($user->Attachment->status) }}</span>
                        </p>
                    </div>
                @else
                    <p>No active Attachment at the moment.</p>
                @endif
            </div>
        </div>

        <div class="detail-card">
            <h3>Application History</h3>
            @if (isset($user->applications) && count($user->applications) > 0)
                <table class="profile-table">
                    <thead>
                        <tr>
                            <th>Organization</th>
                            <th>Position</th>
                            <th>Applied Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user->applications as $application)
                            <tr>
                                <td>{{ $application->posting->organization->name ?? 'N/A' }}</td>
                                <td>{{ $application->posting->title ?? 'N/A' }}</td>
                                <td>{{ date('M d, Y', strtotime($application->created_at)) }}</td>
                                <td>
                                    <span
                                        class="badge badge-{{ $application->status === 'accepted'
                                            ? 'success'
                                            : ($application->status === 'pending'
                                                ? 'warning'
                                                : ($application->status === 'rejected'
                                                    ? 'danger'
                                                    : 'secondary')) }}">
                                        {{ ucfirst($application->status) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No application history found.</p>
            @endif
        </div>
        @include('student.src.profile.partials.document-upload')
    </div>

    <script>
        // Mobile sidebar toggle functionality
        const menuToggle = document.querySelector('.menu-toggle');
        const sidebar = document.querySelector('.sidebar');

        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('open');
        });
    </script>
@endsection
