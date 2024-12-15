<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // Show the user profile
    public function show()
    {
        $user = Auth::user();
        return view('app.pages.profile', compact('user'));
    }

    // Update user profile
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate the incoming request
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'current_password' => 'required_with:password',
            'password' => 'nullable|string|min:8|confirmed',
            'profile_photo' => 'nullable|image|max:2048', // Image size max 2MB
        ]);

        // Verify current password before updating
        if ($request->filled('password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Current password does not match.']);
            }
            // Update password
            $user->password = bcrypt($request->password);
        }

        // Update the username
        $user->username = $request->username;

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Delete old profile photo if exists
            if ($user->profile_photo) {
                Storage::disk('public')->delete('profile_photos/' . $user->profile_photo);
            }

            // Store new profile photo
            $file->storeAs('profile_photos', $filename, 'public');

            // Update user's profile photo
            $user->profile_photo = $filename;
        }

        // Save the updated user information
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }
}
