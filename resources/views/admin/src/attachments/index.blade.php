@extends('admin.layouts.app')
@section('title', 'Attachment Applications')
@section('styles')
    <link rel="stylesheet" href="assets/css/attachment-posting.css">
@endsection

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5>Attachment Posting</h5>
        <div>
            <button class="btn btn-primary" data-toggle="modal" data-target="#newPositionModal">
                + New Position
            </button>
            <a href="{{ url('organizations') }}" class="btn btn-secondary">+ New Organization</a>
        </div>
    </div>
    <hr>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        <!-- New Attachment posting Form -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3>New Attachment</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('attachments.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="position">Attachment Position</label>
                            <select id="position" name="position_id" required>
                                <option value="">Select Position</option>
                                @foreach ($positions as $position)
                                    <option value="{{ $position->id }}">{{ $position->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @if (Auth::user()->hasRole('Organization') && Auth::user()->organization->isNotEmpty())
                            <input type="text"  name="organization_id"
                                value="{{ Auth::user()->organization->first()->id }}">
                        @else
                            <div class="form-group">
                                <label for="organization">Organization</label>
                                <select id="organization" name="organization_id" required>
                                    <option value="">Select Organization</option>
                                    @foreach ($organizations as $organization)
                                        <option value="{{ $organization->id }}">{{ $organization->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" required></textarea>
                        </div>
                        <div class="form-group"><button type="submit">Submit Application</button></div>
                    </form>
                </div>
            </div>
        </div>


        @if (Auth::user()->hasRole('Admin'))
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Organization List</h3>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Organization</th>
                                    <th>Position</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attachments as $attachment)
                                    <tr>
                                        <td>{{ $attachment->organization->name }}</td>
                                        <td>{{ $attachment->position->name }}</td>
                                        <td>{{ $attachment->description ?? 'N/A' }}</td>
                                        <td>
                                            <button class="btn btn-primary btn-sm" data-toggle="modal"
                                                data-target="#editModal{{ $attachment->id }}">Edit</button>
                                            <form action="{{ route('attachments.destroy', $attachment->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Delete this application?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editModal{{ $attachment->id }}" tabindex="-1"
                                        role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form action="{{ route('attachments.update', $attachment->id) }}"
                                                    method="POST">
                                                    @csrf @method('PUT')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Application</h5>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group"><label>Name</label>
                                                            <input type="text" name="name"
                                                                value="{{ $attachment->name }}" class="form-control"
                                                                required>
                                                        </div>
                                                        <div class="form-group"><label>Email</label>
                                                            <input type="email" name="email"
                                                                value="{{ $attachment->email }}" class="form-control"
                                                                required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Position</label>
                                                            <select name="position_id" class="form-control" required>
                                                                @foreach ($positions as $position)
                                                                    <option value="{{ $position->id }}"
                                                                        {{ $attachment->position_id == $position->id ? 'selected' : '' }}>
                                                                        {{ $position->title }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group"><label>Resume Link</label>
                                                            <input type="url" name="resume"
                                                                value="{{ $attachment->resume }}" class="form-control"
                                                                required>
                                                        </div>
                                                        <div class="form-group"><label>Description</label>
                                                            <textarea name="message" class="form-control" required>{{ $attachment->message }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success">Save Changes</button>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
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
        @endif
    </div>

    <!-- New Position Modal -->
    <div class="modal fade" id="newPositionModal" tabindex="-1" role="dialog" aria-labelledby="newPositionModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="positionForm">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">New Position</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="position_name">Position Name</label>
                            <input type="text" id="position_name" name="name" class="form-control" required>
                            <div class="invalid-feedback" id="positionError"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save Position</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            console.log('Document ready');

            // Custom SweetAlert2 toast position and styling
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            $('#positionForm').submit(function(e) {
                e.preventDefault();
                let formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('positions.store') }}",
                    type: "POST",
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            // Show success toast notification
                            Toast.fire({
                                icon: 'success',
                                title: 'Position added successfully!'
                            });

                            $('#newPositionModal').modal('hide');

                            // Reload page after delay
                            setTimeout(function() {
                                location.reload();
                            }, 1500);
                        }
                    },
                    error: function(xhr) {
                        let error = xhr.responseJSON && xhr.responseJSON.errors && xhr
                            .responseJSON.errors.name ?
                            xhr.responseJSON.errors.name[0] :
                            "Something went wrong!";

                        // Show error toast notification
                        Toast.fire({
                            icon: 'error',
                            title: error
                        });

                        $('#positionError').text(error).show();
                        $('#position_name').addClass('is-invalid');
                    }
                });
            });
        });
    </script>
@endsection
