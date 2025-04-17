@php
    $documents = $user->documents;
@endphp

<div class="detail-card">
    <h3>Documents</h3>
    <div class="documents-list">
        @if ($documents && count($documents) > 0)
            <table class="profile-table">
                <thead>
                    <tr>
                        <th>Document Type</th>
                        <th>Uploaded Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($documents as $document)
                        <tr>
                            <td>{{ ucfirst($document->type) }}</td>
                            <td>{{ date('M d, Y', strtotime($document->created_at)) }}</td>
                            <td>
                                <a href="{{ route('document.download', $document->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-download"></i> Download
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No documents uploaded yet.</p>
        @endif

        <button onclick="showDocumentModal()" class="btn btn-success btn-sm">Upload Document</button>
    </div>
</div>


<div class="modal fade" id="uploadDocumentsModal" tabindex="-1" aria-labelledby="uploadDocumentsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('document.upload', $user->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload Documents</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="document-fields">
                    <div class="document-group mb-3">
                        <label>Document Type</label>
                        <select name="documents[0][type]" class="form-select" required>
                            <option value="">Select</option>
                            <option value="cv">CV</option>
                            <option value="transcripts">Transcripts</option>
                            <option value="recommendation_letter">Recommendation Letter</option>
                            <option value="proof_of_insurance">Proof of Insurance</option>
                        </select>
                        <label class="mt-2">Choose File</label>
                        <input type="file" name="documents[0][file]" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="addDocumentField()">+ Add More</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    let documentIndex = 1;

    function addDocumentField() {
        const container = document.getElementById('document-fields');
        const html = `
            <div class="document-group mb-3">
                <label>Document Type</label>
                <select name="documents[${documentIndex}][type]" class="form-select" required>
                    <option value="">Select</option>
                    <option value="cv">CV</option>
                    <option value="transcripts">Transcripts</option>
                    <option value="recommendation_letter">Recommendation Letter</option>
                    <option value="proof_of_insurance">Proof of Insurance</option>
                </select>
                <label class="mt-2">Choose File</label>
                <input type="file" name="documents[${documentIndex}][file]" class="form-control" required>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
        documentIndex++;
    }

    function showDocumentModal() {
        var myModal = new bootstrap.Modal(document.getElementById('uploadDocumentsModal'));
        myModal.show();
    }
</script>
