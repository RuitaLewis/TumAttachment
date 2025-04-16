@extends('admin.layouts.app')
@section('title', 'Post An Attachment')
@section('styles')
    <link rel="stylesheet" href="assets/css/attachment-posting.css">
@endsection

@section('content')

    <div class="form-container">
        <h3>Attachment Application Form</h3>
        <form action="/submit-application" method="POST">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="position">Preferred Attachment Position</label>
                <select id="position" name="position" required>
                    <option value="">Select Position</option>
                    <option value="Software Developer">Software Developer</option>
                    <option value="Data Analyst">Data Analyst</option>
                    <option value="Marketing Intern">Marketing Intern</option>
                </select>
            </div>
            <div class="form-group">
                <label for="resume">Resume Link</label>
                <input type="url" id="resume" name="resume" placeholder="https://example.com/resume" required>
            </div>
            <div class="form-group">
                <label for="message">Why should we hire you?</label>
                <textarea id="message" name="message" required></textarea>
            </div>
            <div class="form-group">
                <button type="submit">Submit Application</button>
            </div>
        </form>
    </div>
    </div>
@endsection
