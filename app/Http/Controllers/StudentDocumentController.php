<?php

namespace App\Http\Controllers;

use App\Models\StudentDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentDocumentController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'documents.*.type' => 'required|string',
            'documents.*.file' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:2048'
        ]);

        foreach ($request->documents as $document) {
            $path = $document['file']->store('student_documents', 'public');
            StudentDocument::create([
                'user_id' => $id,
                'type' => $document['type'],
                'file_path' => $path
            ]);
        }

        return redirect()->back()->with('success', 'Documents uploaded successfully.');
    }

    public function download($id)
    {
        $document = StudentDocument::findOrFail($id);
        return Storage::disk('public')->download($document->file_path);
    }
}
