<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }
    public function attachments()
    {
        return view('pages.attachments.index');
    }
}
