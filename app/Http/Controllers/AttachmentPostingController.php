<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AttachmentPostingController extends Controller
{
    public function index()
    {
        return view('admin.src.attachment-posting.index');
    }
}
