@php
    $applications = $user->attachmentApplications;
@endphp

<div class="detail-card">
    <h3>Application History</h3>
    @if (isset($applications) && count($applications) > 0)
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
                @foreach ($applications as $application)
                    <tr>
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
