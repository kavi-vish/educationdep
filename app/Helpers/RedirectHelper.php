<?php

namespace App\Helpers;

class RedirectHelper
{
    public static function home()
    {
        $user = auth()->user();

        return $user && $user->role === 'Admin'
            ? '/admin/dashboard'
            : '/dashboard';
    }
}