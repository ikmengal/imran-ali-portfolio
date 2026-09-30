<?php

use App\Models\Setting;

if (! function_exists('setting')) {
    /**
     * Get the global settings instance
     */
    function setting(): ?Setting
    {
        return Setting::getSettings();
    }
}

if (! function_exists('checkRocketFlareUser')) {
    /**
     * Check if user is Rocket Flare user
     * Returns 1 for super admin, 2 for regular admin, 0 for others
     */
    function checkRocketFlareUser(): int
    {
        if (! auth()->check()) {
            return 0;
        }

        $user = auth()->user();

        if ($user->hasRole('Super Admin')) {
            return 1;
        }

        if ($user->hasRole('Admin')) {
            return 2;
        }

        return 0;
    }
}
