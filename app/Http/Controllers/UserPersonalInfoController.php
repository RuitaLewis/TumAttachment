<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserPersonalInfo;
use Illuminate\Http\Request;

class UserPersonalInfoController extends Controller
{
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'student_id' => 'nullable|string',
            'phone' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
        ]);

        $user->personalInfo()->updateOrCreate(['user_id' => $user->id], $data);

        return redirect()->back()->with('success', 'Personal information updated successfully!');
    }
}
