@extends('admin.layouts.app')
@section('title', 'Attachment Applications')
@section('styles')
<link rel="stylesheet" href="assets/css/attachment-posting.css">
@endsection

@section('content')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header"><h3>Attachment Application Form</h3></div>
            <div class="card-body">
                <form action="{{ route('attachments.store') }}" method="POST">
                    @csrf
                    <div class="form-group"><label for="name">Full Name</label><input type="text" id="name" name="name" required></div>
                    <div class="form-group"><label for="email">Email Address</label><input type="email" id="email" name="email" required></div>
                    <div class="form-group">
                        <label for="position">Preferred Attachment Position</label>
                        <select id="position" name="position_id" required>
                            <option value="">Select Position</option>
                            @foreach($positions as $position)
                                <option value="{{ $position->id }}">{{ $position->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group"><label for="resume">Resume Link</label><input type="url" id="resume" name="resume" placeholder="https://example.com/resume" required></div>
                    <div class="form-group"><label for="message">Why should we hire you?</label><textarea id="message" name="message" required></textarea></div>
                    <div class="form-group"><button type="submit">Submit Application</button></div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header"><h3>Submitted Applications</h3></div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr><th>Name</th><th>Email</th><th>Position</th><th>Actions</th></tr>
                    </thead>
                    <tbody>
                        @foreach($attachments as $attachment)
                        <tr>
                            <td>{{ $attachment->name }}</td>
                            <td>{{ $attachment->email }}</td>
                            <td>{{ $attachment->position->title ?? 'N/A' }}</td>
                            <td>
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal{{ $attachment->id }}">Edit</button>
                                <form action="{{ route('attachments.destroy', $attachment->id) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this application?')">Delete</button>
                                </form>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{ $attachment->id }}" tabindex="-1" role="dialog">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <form action="{{ route('attachments.update', $attachment->id) }}" method="POST">
                                @csrf @method('PUT')
                                <div class="modal-header">
                                  <h5 class="modal-title">Edit Application</h5>
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group"><label>Name</label><input type="text" name="name" value="{{ $attachment->name }}" class="form-control" required></div>
                                    <div class="form-group"><label>Email</label><input type="email" name="email" value="{{ $attachment->email }}" class="form-control" required></div>
                                    <div class="form-group">
                                        <label>Position</label>
                                        <select name="position_id" class="form-control" required>
                                            @foreach($positions as $position)
                                                <option value="{{ $position->id }}" {{ $attachment->position_id == $position->id ? 'selected' : '' }}>
                                                    {{ $position->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group"><label>Resume Link</label><input type="url" name="resume" value="{{ $attachment->resume }}" class="form-control" required></div>
                                    <div class="form-group"><label>Why should we hire you?</label><textarea name="message" class="form-control" required>{{ $attachment->message }}</textarea></div>
                                </div>
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-success">Save Changes</button>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
