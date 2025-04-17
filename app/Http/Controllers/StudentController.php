<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;

        return view('student.src.profile.index', compact('id'));
    }
}
