@extends('admin.layouts.app')

@section('title', 'Student Profile')

@section('styles')
    <link rel="stylesheet" href="assets/css/student-profile.css">

@endsection
@php
$id = 1;
    // Assuming we're getting a specific user by ID
    // This would typically come from a controller
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
                @if($user->avatar)
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
            <div class="detail-card">
                <h3>Personal Information</h3>
                <table class="details-table">
                    <tr>
                        <th>Student ID:</th>
                        <td>{{ $user->student_id ?? 'Not set' }}</td>
                    </tr>
                    <tr>
                        <th>Phone Number:</th>
                        <td>{{ $user->phone ?? 'Not set' }}</td>
                    </tr>
                    <tr>
                        <th>Date of Birth:</th>
                        <td>{{ $user->date_of_birth ? date('F d, Y', strtotime($user->date_of_birth)) : 'Not set' }}</td>
                    </tr>
                    <tr>
                        <th>Gender:</th>
                        <td>{{ ucfirst($user->gender ?? 'Not set') }}</td>
                    </tr>
                </table>
            </div>

            <div class="detail-card">
                <h3>Academic Information</h3>
                <table class="details-table">
                    <tr>
                        <th>Course:</th>
                        <td>{{ $user->course ?? 'Not set' }}</td>
                    </tr>
                    <tr>
                        <th>Year of Study:</th>
                        <td>{{ $user->year_of_study ?? 'Not set' }}</td>
                    </tr>
                    <tr>
                        <th>Expected Graduation:</th>
                        <td>{{ $user->graduation_date ?? 'Not set' }}</td>
                    </tr>
                    <tr>
                        <th>GPA:</th>
                        <td>{{ $user->gpa ?? 'Not set' }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="detail-card">
            <h3>Internship Status</h3>
            <div class="internship-status">
                @if(isset($user->internship) && $user->internship)
                    <div class="status-details">
                        <p><strong>Organization:</strong> {{ $user->internship->organization->name ?? 'N/A' }}</p>
                        <p><strong>Position:</strong> {{ $user->internship->position ?? 'N/A' }}</p>
                        <p><strong>Start Date:</strong> {{ $user->internship->start_date ? date('F d, Y', strtotime($user->internship->start_date)) : 'N/A' }}</p>
                        <p><strong>End Date:</strong> {{ $user->internship->end_date ? date('F d, Y', strtotime($user->internship->end_date)) : 'N/A' }}</p>
                        <p><strong>Status:</strong> <span class="badge badge-{{ $user->internship->status === 'active' ? 'success' : ($user->internship->status === 'pending' ? 'warning' : 'secondary') }}">{{ ucfirst($user->internship->status) }}</span></p>
                    </div>
                @else
                    <p>No active internship at the moment.</p>
                @endif
            </div>
        </div>

        <div class="detail-card">
            <h3>Application History</h3>
            @if(isset($user->applications) && count($user->applications) > 0)
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
                        @foreach($user->applications as $application)
                            <tr>
                                <td>{{ $application->posting->organization->name ?? 'N/A' }}</td>
                                <td>{{ $application->posting->title ?? 'N/A' }}</td>
                                <td>{{ date('M d, Y', strtotime($application->created_at)) }}</td>
                                <td>
                                    <span class="badge badge-{{
                                        $application->status === 'accepted' ? 'success' :
                                        ($application->status === 'pending' ? 'warning' :
                                        ($application->status === 'rejected' ? 'danger' : 'secondary'))
                                    }}">
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

        <div class="detail-card">
            <h3>Documents</h3>
            <div class="documents-list">
                @if(isset($user->documents) && count($user->documents) > 0)
                    <table class="profile-table">
                        <thead>
                            <tr>
                                <th>Document Type</th>
                                <th>Uploaded Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->documents as $document)
                                <tr>
                                    <td>{{ ucfirst($document->type) }}</td>
                                    <td>{{ date('M d, Y', strtotime($document->created_at)) }}</td>
                                    <td>
                                        <a href="{{ route('document.download', $document->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-download"></i> Download
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No documents uploaded yet.</p>
                @endif
            </div>
        </div>
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