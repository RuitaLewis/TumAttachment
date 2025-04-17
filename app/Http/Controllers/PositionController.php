<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PositionController extends Controller
{
    public function store(Request $request)
    {
        Log::info($request->all());
        $request->validate([
            'name' => 'required|string|max:255|unique:positions,name',
        ]);

        $position = Position::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'status' => 'success',
            'position' => $position
        ]);
    }
}
