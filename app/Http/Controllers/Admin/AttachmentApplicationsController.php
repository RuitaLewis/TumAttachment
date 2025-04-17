<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttachmentApplicationsController extends Controller
{
    public function index()
    {
        return view('admin.src.attachment-applications.index');
    }
}
