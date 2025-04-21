<?php

namespace App\Http\Controllers;

use App\Models\AttachmentApplication;
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
        $user = Auth::user();

        $user->attachmentApplications()->create([
            'user_id' => $user->id,
            'attachment_id' => request('attachment_id'),
            'status' => 'pending',
            'comment' => request('comment'),
            'fit_why' => request('cover_letter'),
            'additional_info' => request('additional_info'),
            'accurate_info' => request()->has('confirm_info'),
        ]);

        // Generate a time-based greeting
        $hour = now()->format('H');
        if ($hour < 12) {
            $greeting = 'Good morning';
        } elseif ($hour < 17) {
            $greeting = 'Good afternoon';
        } else {
            $greeting = 'Good evening';
        }

        // Create a personalized message
        $user->messages()->create([
            'subject' => 'Attachment Application Received',
            'body' => "{$greeting} {$user->name}, your attachment application has been received. Our team will reach out to you once your application has been processed.",
        ]);

        return redirect()->back()->with('success', 'Application submitted successfully.');
    }
   
}
