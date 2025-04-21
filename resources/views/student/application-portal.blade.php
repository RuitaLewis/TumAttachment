@extends('student.layouts.app')

@section('styles')
    <link rel="stylesheet" href="assets/css/attachment-application.css">
@endsection

@php
    $attachment = \App\Models\Attachment::where('id', $id)->first();
    $hasPersonalInfo = Auth::user()->personalInfo()->exists();
    $hasAcademicInfo = Auth::user()->academinInfo()->exists();
    $hasRequiredDocuments =
        Auth::user()
            ->documents()
            ->whereIn('type', ['cv', 'transcripts', 'recommendation_letter'])
            ->count() >= 3;
    $canSubmit = $hasPersonalInfo && $hasAcademicInfo && $hasRequiredDocuments;
@endphp

@section('content')
    <div class="header">
        <h4>Apply for Attachment</h4>
        <p>{{ $attachment->position->name }} at {{ $attachment->organization->name }}</p>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if (session('warning'))
            <div class="alert alert-warning">
                {{ session('warning') }}
            </div>
        @endif
        @if (session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif

    </div>

    @if (!$canSubmit)
        <div class="alert alert-warning">
            <h5>Required Information Missing</h5>
            <p>Before submitting your application, please complete the following:</p>
            <ul>
                @if (!$hasPersonalInfo)
                    <li>Complete your <a href="{{ route('student-profile') }}">personal information</a></li>
                @endif
                @if (!$hasAcademicInfo)
                    <li>Add your <a href="{{ route('student-profile') }}">academic information</a></li>
                @endif
                @if (!$hasRequiredDocuments)
                    <li>Upload all required documents <a href="{{ route('student-profile') }}">here</a> (CV, transcripts,
                        and
                        recommendation letter)</li>
                @endif
            </ul>
        </div>
    @endif

    <div class="application-instructions">
        <h5>Instructions:</h5>
        <ol>
            <li>All fields marked with * are mandatory</li>
            <li>Your personal and academic information will be automatically attached to your application</li>
            <li>Ensure your CV, transcripts, and recommendation letter are uploaded before submission</li>
            <li>Provide a compelling reason why you're suitable for this position</li>
        </ol>
    </div>

    <hr>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Attachment Application Form</h3>
                </div>

                <div class="card-body">
                    <div class="section-header">
                        <h4>Personal Information</h4>
                        @if ($hasPersonalInfo)
                            <span class="status complete">Complete</span>
                        @else
                            <span class="status incomplete">Incomplete</span>
                        @endif
                    </div>
                    <div class="info-preview">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
                                <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                            </div>
                            <div class="col-md-6">
                                @if ($hasPersonalInfo)
                                    <p><strong>Student ID:</strong> {{ Auth::user()->personalInfo->student_id }}</p>
                                    <p><strong>Phone:</strong> {{ Auth::user()->personalInfo->phone }}</p>
                                @else
                                    <p class="text-danger">Please complete your personal information</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="section-header">
                        <h4>Academic Information</h4>
                        @if ($hasAcademicInfo)
                            <span class="status complete">Complete</span>
                        @else
                            <span class="status incomplete">Incomplete</span>
                        @endif
                    </div>

                    <div class="info-preview">
                        @if ($hasAcademicInfo)
                            <div class="row">
                                <div class="col-md-4">
                                    <p><strong>Course:</strong> {{ Auth::user()->academinInfo->course }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><strong>Year of Study:</strong> {{ Auth::user()->academinInfo->year_of_study }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><strong>Expected Graduation:</strong>
                                        {{ Auth::user()->academinInfo->graduation_date }}</p>
                                </div>
                            </div>
                        @else
                            <p class="text-danger">Please complete your academic information</p>
                        @endif
                    </div>

                    <div class="section-header">
                        <h4>Required Documents</h4>
                        @if ($hasRequiredDocuments)
                            <span class="status complete">Complete</span>
                        @else
                            <span class="status incomplete">Incomplete</span>
                        @endif
                    </div>

                    <div class="info-preview documents-preview">
                        <div class="row">
                            @php
                                $documentTypes = [
                                    'cv' => 'CV/Resume',
                                    'transcripts' => 'Academic Transcript',
                                    'recommendation_letter' => 'Recommendation Letter',
                                ];
                                $uploadedDocs = Auth::user()->documents()->pluck('file_path', 'type')->toArray();
                            @endphp

                            @foreach ($documentTypes as $type => $label)
                                <div class="col-md-4">
                                    <div class="document-card {{ isset($uploadedDocs[$type]) ? 'uploaded' : 'missing' }}">
                                        <div class="doc-icon">
                                            <i
                                                class="fas fa-{{ isset($uploadedDocs[$type]) ? 'check-circle' : 'times-circle' }}"></i>
                                        </div>
                                        <h5>{{ $label }}</h5>
                                        @if (isset($uploadedDocs[$type]))
                                            <p class="text-success">Uploaded</p>
                                        @else
                                            <p class="text-danger">Missing</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <form action="{{ route('student.attachments.apply', $attachment->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="attachment_id" value="{{ $attachment->id }}">

                        <div class="attachment-details">
                            <div class="form-group">
                                <label>Attachment Position</label>
                                <input type="text" value="{{ $attachment->position->name }}" readonly
                                    class="form-control-plaintext">
                            </div>

                            <div class="form-group">
                                <label>Organization</label>
                                <input type="text" value="{{ $attachment->organization->name }}" readonly
                                    class="form-control-plaintext">
                            </div>

                            <div class="form-group">
                                <label>Duration</label>
                                <input type="text" value="{{ $attachment->duration }}" readonly
                                    class="form-control-plaintext">
                            </div>

                            <div class="form-group">
                                <label>Location</label>
                                <input type="text" value="{{ $attachment->organization->location }}" readonly
                                    class="form-control-plaintext">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cover_letter">Why are you a good fit for this position? *</label>
                            <textarea id="cover_letter" name="cover_letter" rows="6" required class="form-control"
                                placeholder="Explain why you're interested in this position and how your skills and experiences make you a good candidate..."></textarea>
                            <small class="form-text text-muted">This will serve as your cover letter (300-500 words
                                recommended)</small>
                        </div>

                        <div class="form-group">
                            <label for="additional_info">Additional Information (Optional)</label>
                            <textarea id="additional_info" name="additional_info" rows="4" class="form-control"
                                placeholder="Any other information you would like the employer to know..."></textarea>
                        </div>

                        <div class="form-check mb-4">
                            <input type="checkbox" id="confirm_info" name="confirm_info" class="form-check-input" required>
                            <label for="confirm_info" class="form-check-label">I confirm that all information provided is
                                accurate and complete</label>
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary btn-lg" {{ $canSubmit ? '' : 'disabled' }}>
                                Submit Application
                            </button>
                            @if (!$canSubmit)
                                <p class="text-danger mt-2">Please complete all required information before submitting</p>
                            @endif
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
