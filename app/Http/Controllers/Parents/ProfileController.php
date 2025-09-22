<?php

namespace App\Http\Controllers\Parents;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('parents.auth');
    }

    public function index()
    {
        $user = Auth::user();
        return view('parents.profile.index', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('parents.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'mobile_no' => 'nullable|string|max:20',
        ]);

        Auth::user()->update($request->only(['name', 'email', 'mobile_no']));

        return redirect()->route('parents.profile.index')->with('success', 'Profile updated successfully.');
    }
}