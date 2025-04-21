@extends('admin.layouts.app')

@section('title', 'Application Details')

@section('styles')
    <style>
        .application-details {
            max-width: 900px;
            margin: 30px auto;
            background: #fff;
            border-radius: 10px;
            padding: 25px 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .application-details h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 28px;
            color: #333;
        }

        .application-details h3 {
            margin-top: 25px;
            font-size: 22px;
            border-bottom: 1px solid #eee;
            padding-bottom: 8px;
            color: #444;
        }

        .application-details p {
            font-size: 16px;
            margin: 8px 0;
            color: #555;
        }

        .application-details a {
            display: inline-block;
            margin: 5px 0;
            text-decoration: none;
            color: #007bff;
            font-weight: 500;
        }

        .application-details a:hover {
            text-decoration: underline;
        }

        .application-details form {
            margin-top: 20px;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        .application-details label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #333;
        }

        .application-details input[type="text"],
        .application-details textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 15px;
        }

        .application-details textarea {
            resize: vertical;
        }

        .application-details .btn {
            display: inline-block;
            background: #007bff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 6px;
            border: none;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .application-details .btn:hover {
            background: #0056b3;
        }
    </style>
@endsection

@section('content')
    <div class="application-details">

        <h2>Application Details</h2>

        {{-- Personal Information --}}
        <h3>Student Information</h3>
        <p>Name: {{ $application->user->name }}</p>
        <p>Email: {{ $application->user->email }}</p>

        @if ($application->user->personalInfo)
            <p>Phone: {{ $application->user->personalInfo->phone ?? 'N/A' }}</p>
            <p>Student ID: {{ $application->user->personalInfo->student_id ?? 'N/A' }}</p>
            <p>Date of Birth: {{ $application->user->personalInfo->date_of_birth ?? 'N/A' }}</p>
            <p>Gender: {{ $application->user->personalInfo->gender ?? 'N/A' }}</p>
        @else
            <p>Personal info not provided.</p>
        @endif

        {{-- Academic Information --}}
        <h3>Academic Information</h3>
        @if ($application->user->academicInfo)
            <p>Course: {{ $application->user->academicInfo->course ?? 'N/A' }}</p>
            <p>Year of Study: {{ $application->user->academicInfo->year_of_study ?? 'N/A' }}</p>
            <p>Graduation Date: {{ $application->user->academicInfo->graduation_date ?? 'N/A' }}</p>
        @else
            <p>Academic information not provided.</p>
        @endif

        {{-- Attached Documents --}}
        <h3>Attached Documents</h3>
        @if ($application->user->documents->count() > 0)
            @foreach ($application->user->documents as $doc)
                <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank">{{ ucfirst($doc->type) }}</a><br>
            @endforeach
        @else
            <p>No documents uploaded.</p>
        @endif

        {{-- Application Status --}}
        <h3>Application Status</h3>
        <p>Status: <strong>{{ ucfirst($application->status) }}</strong></p>

        @if($application->comment)
            <p><strong>Admin Comment:</strong> {{ $application->comment }}</p>
        @endif
        @if($application->fit_why)
            <p><strong>Why Fit:</strong> {{ $application->fit_why }}</p>
        @endif
        @if($application->additional_info)
            <p><strong>Additional Info:</strong> {{ $application->additional_info }}</p>
        @endif
        <p>Accurate Information Provided: {{ $application->accurate_info ? 'Yes' : 'No' }}</p>

        {{-- Message Form --}}
        <h3>Send Message to Student</h3>
        <form action="{{ route('messages.store') }}" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{ $application->user->id }}">
            <div>
                <label for="subject">Subject</label>
                <input type="text" name="subject" class="form-control" required>
            </div>
            <div>
                <label for="body">Message</label>
                <textarea name="body" class="form-control" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Send Message</button>
        </form>

    </div>
@endsection
