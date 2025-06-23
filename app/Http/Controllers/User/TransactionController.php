<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Tampilkan daftar transaksi user
     */
    public function index()
    {
        $transactions = Transaction::with(['book.reviews'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('user.transactions.index', compact('transactions'));
    }

    /**
     * Simpan transaksi pembelian buku
     */
    public function store(Book $book)
    {
        $user = Auth::user();

        // Cek apakah user sudah membeli buku ini
        if (Transaction::where('user_id', $user->id)->where('book_id', $book->id)->exists()) {
            return back()->with('error', 'Kamu sudah membeli buku ini.');
        }

        Transaction::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'price' => $book->price,
            'status' => 'success', // bisa juga 'pending' kalau ada sistem pembayaran
            'transaction_date' => now(),
        ]);

        return redirect()->route('user.user.transactions.index')->with('success', 'Pembelian berhasil!');
    }

    /**
     * Batalkan transaksi (jika belum sukses)
     */
    public function cancel($id)
    {
        $transaction = Transaction::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($transaction->status === 'success') {
            return back()->with('error', 'Transaksi yang sudah berhasil tidak bisa dibatalkan.');
        }

        $transaction->update(['status' => 'canceled']);

        return back()->with('success', 'Transaksi berhasil dibatalkan.');
    }
}
