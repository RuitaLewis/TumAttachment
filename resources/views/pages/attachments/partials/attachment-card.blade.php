@php
    $attachments = App\Models\Attachment::all();
@endphp

@foreach ($attachments as $attachment)
    <div class="attachment-card">
        <div class="card-header">
            <h4>{{ $attachment->position->name }}</h4>
        </div>
        <div class="card-body">
            <div class="attachment-info">
                <i class="fas fa-building"></i>
                <span>{{ $attachment->organization->name }}</span>
            </div>
            <div class="attachment-info">
                <i class="fas fa-calendar-alt"></i>
                <span> Posted on {{ $attachment->created_at->format('F j, Y') }}</span>

            </div>
            <div class="attachment-description">
                <p>{{ $attachment->description }}</p>
            </div>
            <a  href="{{ url('attachment-application/' . $attachment->id ) }}" class="btn-apply text-decoration-none">Apply Now</a>
        </div>
    </div>
@endforeach
