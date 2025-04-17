<?php

namespace App\Http\Controllers;

use App\Models\AcademicInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AcademicInformationController extends Controller
{
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'course' => 'nullable|string|max:255',
            'year_of_study' => 'nullable|string|max:255',
            'graduation_date' => 'nullable|string|max:255',
        ]);

        $academicInfo = AcademicInformation::updateOrCreate(
            ['user_id' => $id],
            $data
        );

        return redirect()->back()->with('success', 'Academic Information Updated!');
    }
}
