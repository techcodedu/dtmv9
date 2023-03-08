<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CampusExtension extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
    $this->middleware('role:campus_extensions');
}

    public function dashboard()
    {
        $user = Auth::user();
        return view('campus_extension.dashboard', compact('user'));

    }

    // public function profile()
    // {
    //     $user = Auth::user();

    //     return view('college.profile', compact('user'));
    // }

    // public function updateProfile(Request $request)
    // {
    //     $user = Auth::user();

    //     // Update user profile data

    //     return redirect()->back()->with('success', 'Profile updated successfully.');
    // }

 
}
