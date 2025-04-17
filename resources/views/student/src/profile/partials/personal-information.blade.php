@php
    $info = $user->personalInfo;
@endphp

<div class="detail-card">
    <h3>Personal Information</h3>
    <table class="details-table">
        <tr>
            <th>Student ID:</th>
            <td>{{ $info->student_id ?? 'Not set' }}</td>
        </tr>
        <tr>
            <th>Phone Number:</th>
            <td>{{ $info->phone ?? 'Not set' }}</td>
        </tr>
        <tr>
            <th>Date of Birth:</th>
            <td>{{ $info?->date_of_birth ? date('F d, Y', strtotime($info->date_of_birth)) : 'Not set' }}</td>
        </tr>
        <tr>
            <th>Gender:</th>
            <td>{{ ucfirst($info->gender ?? 'Not set') }}</td>
        </tr>
    </table>
    <button class="btn btn-info mt-2" onclick="showModal()">Edit</button>

    <script>
        function showModal() {
            var myModal = new bootstrap.Modal(document.getElementById('editPersonalInfoModal'));
            myModal.show();
        }
    </script>
</div>

<!-- Modal -->
<div class="modal fade" id="editPersonalInfoModal" tabindex="-1" aria-labelledby="editPersonalInfoModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('personal-info.update', $user->id) }}">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Personal Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Student Registration Number</label>
                        <input type="text" name="student_id" class="form-control"
                            value="{{ $info->student_id ?? '' }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-control" value="{{ $info->phone ?? '' }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Date of Birth</label>
                        <input type="date" name="date_of_birth" class="form-control"
                            value="{{ $info->date_of_birth ?? '' }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gender</label>
                        <select name="gender" class="form-select">
                            <option value="">Select</option>
                            <option value="male" {{ $info?->gender == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ $info?->gender == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ $info?->gender == 'other' ? 'selected' : '' }}>Other</option>
                        </select>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
