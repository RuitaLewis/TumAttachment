<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AttachmentApplication;
use Illuminate\Http\Request;

class AttachmentApplicationsController extends Controller
{
    public function index()
    {
        return view('admin.src.attachment-applications.index');
    }
    public function show($id)
    {
        $application = AttachmentApplication::with(['user', 'attachment.organization', 'attachment.position'])->findOrFail($id);

        return view('admin.src.attachment-applications.show.index', compact('application'));
    }
}
