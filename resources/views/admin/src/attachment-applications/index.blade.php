@extends('admin.layouts.app')

@php
    $totalusers = \App\Models\User::all()->count();
    $users = \App\Models\user::all();
    $applications = \App\Models\AttachmentApplication::all();
    $totatApplications = \App\Models\AttachmentApplication::all()->count();
    $totalActive = \App\Models\AttachmentApplication::where('status', 'active')->count();
    $totalInactive = \App\Models\AttachmentApplication::where('status', 'inactive')->count();
    $totalCompleted = \App\Models\AttachmentApplication::where('status', 'completed')->count();
    $totalPending = \App\Models\AttachmentApplication::where('status', 'pending')->count();

@endphp
@section('styles')
<link rel="stylesheet" href="assets/css/student-profile.css">

@endsection
@section('content')


    <div class="stats-grid">
        <div class="stat-card">
            <h3>Applications</h3>
            <div class="stat-value">{{ $totatApplications }}</div>
        </div>
        <div class="stat-card">
            <h3>Pending Applications</h3>
            <div class="stat-value">{{ $totalPending }}</div>
        </div>
        <div class="stat-card">
            <h3>Completed Applications</h3>
            <div class="stat-value">{{ $totalCompleted }}</div>
        </div>
    </div>



    <div class="profile-container">
        <h3>Applications</h3>
        @if (isset($applications) && count($applications) > 0)
        <table class="profile-table">
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Organization</th>
                    <th>Position</th>
                    <th>Applied Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($applications as $application)
                    <tr onclick="window.location='{{ route('applications.show', $application->id) }}'" style="cursor: pointer;">
                        <td>{{ $application->user->name ?? 'N/A' }}</td>
                        <td>{{ $application->attachment->organization->name ?? 'N/A' }}</td>
                        <td>{{ $application->attachment->position->name ?? 'N/A' }}</td>
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

@endsection
