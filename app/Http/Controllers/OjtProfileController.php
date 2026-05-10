<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OjtProfile;
use Illuminate\Support\Facades\Auth;

class OjtProfileController extends Controller
{
    public function edit()
    {
        $profile = OjtProfile::firstOrCreate(
            ['user_id' => Auth::id()],
            [
                'company_name' => '',
                'department' => '',
                'start_date' => now(),
                'end_date' => now(),
            ]
        );

        return view('ojt-profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'company_name' => 'required',
            'department' => 'nullable',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        OjtProfile::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'company_name' => $request->company_name,
                'department' => $request->department,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]
        );

        return redirect()->route('dashboard')->with('success', 'Profil OJT berjaya dikemaskini.');
    }
}
