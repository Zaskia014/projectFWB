<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Tampilkan daftar transaksi milik user yang sedang login
     */
    public function index()
    {
        // Ambil transaksi user dengan eager loading data buku, urut terbaru, paginasi 10 per halaman
        $transactions = Transaction::with('book')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('user.transactions.index', compact('transactions'));
    }

    /**
     * Simpan transaksi pembelian buku oleh user
     */
    public function store(Book $book)
    {
        $user = Auth::user();

        // Cek apakah user sudah pernah membeli buku ini
        $alreadyBought = Transaction::where('user_id', $user->id)
            ->where('book_id', $book->id)
            ->exists();

        if ($alreadyBought) {
            return redirect()->back()->with('error', 'Kamu sudah membeli buku ini.');
        }

        try {
            Transaction::create([
                'user_id' => $user->id,
                'book_id' => $book->id,
                'price'   => $book->price,
            ]);
        } catch (\Exception $e) {
            // Log error jika perlu: \Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat membeli buku.');
        }

        return redirect()->route('user.books.show', $book->id)->with('success', 'Pembelian berhasil!');
    }
}
