<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Menampilkan daftar transaksi user
     */
    public function index()
    {
        $transactions = Transaction::with(['book.reviews']) // Load relasi untuk ulasan juga
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('user.transactions.index', compact('transactions'));
    }

    /**
     * Menyimpan transaksi pembelian buku
     */
    public function store(Book $book)
    {
        $user = Auth::user();

        // Cek jika user sudah membeli buku ini
        if (Transaction::where('user_id', $user->id)->where('book_id', $book->id)->exists()) {
            return back()->with('error', 'Kamu sudah membeli buku ini.');
        }

        Transaction::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'price' => $book->price,
            'status' => 'success', // bisa diganti 'pending' kalau ada proses pembayaran
            'transaction_date' => now(),
        ]);

        return redirect()->route('transactions.index')->with('success', 'Pembelian berhasil!');
    }

    /**
     * Membatalkan transaksi (jika belum berhasil)
     */
    public function cancel($id)
    {
        $transaction = Transaction::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($transaction->status === 'success') {
            return back()->with('error', 'Transaksi yang sudah berhasil tidak dapat dibatalkan.');
        }

        $transaction->update(['status' => 'canceled']);

        return back()->with('success', 'Transaksi berhasil dibatalkan.');
    }
}
