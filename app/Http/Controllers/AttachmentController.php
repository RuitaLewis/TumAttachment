<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Organization;
use App\Models\Position;
use Illuminate\Http\Request;

class AttachmentController extends Controller
{
    public function index()
    {
        $attachments = Attachment::all();
        $positions = Position::all();
        $organizations = Organization::all();
        return view('admin.src.attachments.index', compact('attachments', 'positions', 'organizations'));
    }

    public function store(Request $request)
    {
        Attachment::create($request->all());
        return redirect()->back()->with('success', 'Attachment Position saved!');
    }

    public function update(Request $request, Attachment $attachment)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'position' => 'required',
            'resume' => 'required|url',
            'message' => 'required',
        ]);

        $attachment->update($request->all());

        return redirect()->back()->with('success', 'Application updated!');
    }

    public function destroy(Attachment $attachment)
    {
        $attachment->delete();

        return redirect()->back()->with('success', 'Application deleted!');
    }
}

