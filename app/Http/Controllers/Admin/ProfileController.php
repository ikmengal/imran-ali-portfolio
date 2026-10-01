<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('admin.profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'professional_title' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'portfolio_slug' => 'nullable|string|max:255|alpha_dash|unique:users,portfolio_slug,'.$user->id,
            'phone' => 'nullable|string|max:50',
            'location' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'github' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'youtube' => 'nullable|url|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'portfolio_header' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
        ]);

        if ($request->hasFile('profile_image')) {
            if ($user->profile_image) {
                Storage::disk('public')->delete('users/'.$user->profile_image);
            }
            $file = $request->file('profile_image');
            $filename = 'profile_'.$user->id.'_'.time().'.'.$file->getClientOriginalExtension();
            $file->storeAs('users', $filename, 'public');
            $validated['profile_image'] = $filename;
        }

        if ($request->hasFile('portfolio_header')) {
            if ($user->portfolio_header) {
                Storage::disk('public')->delete('users/'.$user->portfolio_header);
            }
            $file = $request->file('portfolio_header');
            $filename = 'header_'.$user->id.'_'.time().'.'.$file->getClientOriginalExtension();
            $file->storeAs('users', $filename, 'public');
            $validated['portfolio_header'] = $filename;
        }

        if ($request->hasFile('logo')) {
            if ($user->logo) {
                Storage::disk('public')->delete('users/'.$user->logo);
            }
            $file = $request->file('logo');
            $filename = 'logo_'.$user->id.'_'.time().'.'.$file->getClientOriginalExtension();
            $file->storeAs('users', $filename, 'public');
            $validated['logo'] = $filename;
        }

        $user->update($validated);

        return redirect()->route('admin.profile.index')
            ->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user->update(['password' => Hash::make($validated['password'])]);

        return redirect()->route('admin.profile.index')
            ->with('success', 'Password updated successfully.');
    }
}