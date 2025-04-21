<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        \App\Models\Message::create([
            'user_id' => $request->user_id,
            'subject' => $request->subject,
            'body' => $request->body,
        ]);

        return redirect()->back()->with('success', 'Message sent successfully.');
    }
}
