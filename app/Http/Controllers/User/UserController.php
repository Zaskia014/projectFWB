<?php

// namespace App\Http\Controllers\Admin;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;

// class UserController extends Controller
// {
//     public function index()
//     {
//         // Cek apakah user yang login role-nya admin
//         if (auth()->user()->role !== 'admin') {
//             abort(403, 'Unauthorized');
//         }

//         // Jika admin, lanjutkan proses, misal ambil data user semua
//         $users = \App\Models\User::all();

//         // Kembalikan view dengan data user
//         return view('admin.users.index', compact('users'));
//     }

//     // Method CRUD lain juga bisa kamu beri pengecekan role sama jika perlu
// }
