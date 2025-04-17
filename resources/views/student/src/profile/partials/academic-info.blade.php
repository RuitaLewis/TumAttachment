@php
    $academic = $user->academinInfo;
@endphp

<div class="detail-card">
    <h3>Academic Information</h3>
    <table class="details-table">
        <tr>
            <th>Course:</th>
            <td>{{ $academic->course ?? 'Not set' }}</td>
        </tr>
        <tr>
            <th>Year of Study:</th>
            <td>{{ $academic->year_of_study ?? 'Not set' }}</td>
        </tr>
        <tr>
            <th>Expected Graduation:</th>
            <td>{{ $academic->graduation_date ?? 'Not set' }}</td>
        </tr>

    </table>
    <button class="btn btn-info mt-2" onclick="showeditAcademicInfoModal()">Edit</button>

    <script>
        function showeditAcademicInfoModal() {
            var myModal = new bootstrap.Modal(document.getElementById('editAcademicInfoModal'));
            myModal.show();
        }
    </script>
</div>

<div class="modal fade" id="editAcademicInfoModal" tabindex="-1" aria-labelledby="editAcademicInfoModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('academic.update', $user->id) }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Academic Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Course</label>
                        <input type="text" name="course" class="form-control" value="{{ $academic?->course }}">
                    </div>
                    <div class="mb-3">
                        <label>Year of Study</label>
                        <input type="text" name="year_of_study" class="form-control"
                            value="{{ $academic?->year_of_study }}">
                    </div>
                    <div class="mb-3">
                        <label>Expected Graduation</label>
                        <input type="text" name="graduation_date" class="form-control"
                            value="{{ $academic?->graduation_date }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
