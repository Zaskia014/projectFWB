<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Favorite;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    // Menampilkan semua buku favorit user
    public function index()
    {
        $favorites = Favorite::where('user_id', Auth::id())
            ->with('book') // eager loading untuk akses cover, title, dll.
            ->get();

        return view('user.favorite.index', compact('favorites'));
    }

    // Menambahkan buku ke favorit, hanya jika sudah dibeli
    public function store(Book $book)
    {
        $userId = Auth::id();

        // Validasi: user hanya boleh favorit buku yang sudah dibeli
        $hasBought = Transaction::where('user_id', $userId)
            ->where('book_id', $book->id)
            ->exists();

        if (!$hasBought) {
            return back()->with('error', 'Kamu harus membeli buku ini terlebih dahulu sebelum menyimpannya ke favorit.');
        }

        Favorite::firstOrCreate([
            'user_id' => $userId,
            'book_id' => $book->id,
        ]);

        return back()->with('success', 'Buku ditambahkan ke favorit.');
    }

    // Menghapus buku dari favorit
    public function destroy(Book $book)
    {
        Favorite::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->delete();

        return back()->with('success', 'Buku dihapus dari favorit.');
    }
}
