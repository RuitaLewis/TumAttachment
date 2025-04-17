<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttachmentApplicationController extends Controller
{
    public function index(?int $id = null)
    {
        return view('student.application-portal', compact('id'));
    }
    public function store()
    {
        Auth::user()->attachmentApplications()->create([
            'user_id' => Auth::id(),
            'attachment_id' => request('attachment_id'),
            'status' => 'pending',
            'comment' => request('comment'),
            'fit_why' => request('cover_letter'),
            'additional_info' => request('additional_info'),
            'accurate_info' => request()->has('confirm_info'),
        ]);

        return redirect()->back()->with('success', 'Application submitted successfully.');
    }
}
