<?php

// namespace App\Http\Responses;

// use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

// class LoginResponse implements LoginResponseContract
// {
//     public function toResponse($request)
//     {
//         $user = $request->user();

//         if ($user->role === 'admin') {
//             return redirect()->route('admin.dashboard');
//         } elseif ($user->role === 'author') {
//             return redirect()->route('author.dashboard');
//         } else {
//             return redirect()->route('user.dashboard');
//         }
//     }
// }
