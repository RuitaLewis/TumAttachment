<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AttachmentApplicationController extends Controller
{
    public function index(?int $id = null)
    {
        return view('student.application-portal');
    }
}
