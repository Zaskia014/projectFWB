<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/redirect-by-role';

    public function boot(): void
    {
        // Route::middleware(['web', 'auth'])
        //     ->group(function () {
        //         Route::get('/redirect-by-role', function () {
        //             $user = auth()->user();

        //             if ($user->role === 'admin') {
        //                 return redirect()->route('admin.dashboard');
        //             } elseif ($user->role === 'author') {
        //                 return redirect()->route('author.dashboard');
        //             } else {
        //                 return redirect()->route('user.dashboard');
        //             }
            //     });
            // });
    }
}
