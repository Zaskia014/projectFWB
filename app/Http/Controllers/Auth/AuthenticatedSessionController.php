<?php

// namespace App\Http\Controllers\Auth;

// use App\Http\Controllers\Controller;
// use App\Http\Requests\Auth\LoginRequest;
// use Illuminate\Http\RedirectResponse;

// use Illuminate\Support\Facades\Auth;
// use Illuminate\View\View;

// use Illuminate\Http\Request;

// class AuthenticatedSessionController extends Controller
// {
//     /**
//      * Display the login view.
//      */
//     public function create(): View
//     {
//         return view('auth.login');
//     }

//     /**
//      * Handle an incoming authentication request.
//      */

//     public function store(LoginRequest $request): RedirectResponse
//     {
//         $request->authenticate();

//         $request->session()->regenerate();

//         // Redirect sesuai role
//         $role = Auth::user()->role;

//         if ($role === 'admin') {
//             return redirect()->route('admin.dashboard');
//         } elseif ($role === 'author') {
//             return redirect()->route('author.dashboard');
//         } else {
//             return redirect()->route('user.dashboard');
//         }
// }
//     public function destroy(Request $request): RedirectResponse
//     {
//         Auth::guard('web')->logout();

//         $request->session()->invalidate();

//         $request->session()->regenerateToken();

//         return redirect('/');
//     }
// }
