<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::firstOrCreate([]);

        return view('admin.settings.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = Setting::firstOrCreate([]);

        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'white_name' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'white_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png|max:1024',
            'footer_text' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:500',
            'social_links' => 'nullable|array',
            'social_links.facebook' => 'nullable|url|max:255',
            'social_links.twitter' => 'nullable|url|max:255',
            'social_links.linkedin' => 'nullable|url|max:255',
            'social_links.instagram' => 'nullable|url|max:255',
            'social_links.youtube' => 'nullable|url|max:255',
            'social_links.github' => 'nullable|url|max:255',
            'meta_data' => 'nullable|json',
        ]);

        if ($request->hasFile('logo')) {
            if ($setting->logo) {
                Storage::disk('public')->delete('admin/assets/settings/'.$setting->logo);
            }
            $file = $request->file('logo');
            $filename = 'logo_'.time().'.'.$file->getClientOriginalExtension();
            $file->storeAs('admin/assets/settings', $filename, 'public');
            $validated['logo'] = $filename;
        }

        if ($request->hasFile('white_logo')) {
            if ($setting->white_logo) {
                Storage::disk('public')->delete('admin/assets/settings/'.$setting->white_logo);
            }
            $file = $request->file('white_logo');
            $filename = 'white_logo_'.time().'.'.$file->getClientOriginalExtension();
            $file->storeAs('admin/assets/settings', $filename, 'public');
            $validated['white_logo'] = $filename;
        }

        if ($request->hasFile('favicon')) {
            if ($setting->favicon) {
                Storage::disk('public')->delete('admin/assets/settings/'.$setting->favicon);
            }
            $file = $request->file('favicon');
            $filename = 'favicon_'.time().'.'.$file->getClientOriginalExtension();
            $file->storeAs('admin/assets/settings', $filename, 'public');
            $validated['favicon'] = $filename;
        }

        if ($request->filled('social_links')) {
            $validated['social_links'] = array_filter($request->social_links);
        }

        if ($request->filled('meta_data')) {
            $validated['meta_data'] = json_decode($request->meta_data, true);
        }

        $setting->update($validated);

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings updated successfully.');
    }
}
