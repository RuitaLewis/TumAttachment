<style>
    .no-applications {
        text-align: center;
        padding: 30px;
        background: #f8f9fa;
        border: 1px dashed #ced4da;
        border-radius: 12px;
        margin-top: 20px;
    }

    .no-applications h4 {
        color: #343a40;
        font-size: 1.5rem;
        margin-bottom: 15px;
    }

    .no-applications p {
        color: #6c757d;
        font-size: 1rem;
        margin: 10px 0;
    }

    .document-list {
        list-style: none;
        padding: 0;
        margin: 15px 0;
    }

    .document-list li {
        font-size: 1rem;
        color: #495057;
        margin: 5px 0;
    }

    .apply-button {
        display: inline-block;
        background: linear-gradient(45deg, #007bff, #0056b3);
        color: white;
        padding: 12px 25px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .apply-button:hover {
        background: linear-gradient(45deg, #0056b3, #007bff);
        transform: translateY(-2px);
    }
</style>
@php
    $myapplications = \App\Models\AttachmentApplication::where('user_id', $user->id)->get();
@endphp

<div class="detail-card">
    <h3>Attachment Applications</h3>
    @if (isset($myapplications) && count($myapplications) > 0)
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
                @foreach ($myapplications as $application)
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
        <div class="no-applications">
            <h4>No Application History Found</h4>
            <p>
                You haven't submitted any applications yet! To get started, gather your documents including:
            </p>
            <ul class="document-list">
                <li>✅ Updated CV</li>
                <li>✅ Recent Result Slips</li>
                <li>✅ Recomendation Letter</li>
            </ul>
            <p>
                Once you're ready, click the button below to explore available attachments and submit your application.
            </p>
            <a href="{{ route('attachments') }}" class="apply-button">
                Browse Available Attachments
            </a>
        </div>
    @endif
</div>
