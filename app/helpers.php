<?php

use Illuminate\Support\Facades\Route;

if (! function_exists('active_link')) {
    function active_link(string $name, string $active = 'active') : string {
        return Route::is($name) ? $active : '';
    }
}

if (!function_exists('alert')) {
    function alert(string $value, string $alertType = 'success') {
        $alertType = preg_replace("/.*error.*/ui", 'danger', $alertType);

        session()->flash('alert', $value);
        session()->flash('alertType', 'alert-'.$alertType);
    }
}
