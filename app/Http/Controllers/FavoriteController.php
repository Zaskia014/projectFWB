<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    /**
     * Simpan atau hapus buku dari favorit user
     */
    public function toggle(Book $book)
    {
        $user = Auth::user();

        $isFavorited = $book->favoritedBy()->where('user_id', $user->id)->exists();

        if ($isFavorited) {
            // Hapus dari favorit
            $book->favoritedBy()->detach($user->id);
            return back()->with('success', 'Buku dihapus dari favorit.');
        } else {
            // Tambahkan ke favorit
            $book->favoritedBy()->attach($user->id);
            return back()->with('success', 'Buku ditambahkan ke favorit.');
        }
    }

    /**
     * Menampilkan daftar buku favorit user
     */
    public function index()
    {
        $user = Auth::user();
        $favorites = $user->favorites()->with('book.category')->get();

        return view('user.favorite.index', compact('favorites'));
    }
}
