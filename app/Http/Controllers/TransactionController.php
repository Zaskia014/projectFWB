<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    // Tampilkan semua transaksi milik user yang sedang login
    public function index()
    {
        $transactions = Transaction::where('user_id', Auth::id())->with('book')->latest()->get();
        return view('user.transactions.index', compact('transactions'));
    }

    // Proses pembelian buku (hanya bisa dilakukan dari detail buku)
    public function store(Book $book)
    {
        // Cek apakah user sudah pernah membeli buku ini
        $alreadyBought = Transaction::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->exists();

        if ($alreadyBought) {
            return redirect()->back()->with('error', 'Kamu sudah membeli buku ini.');
        }

        // Simpan transaksi
        Transaction::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'price'   => $book->price, // optional jika kamu punya kolom harga di transaksi
        ]);

        return redirect()->route('user.transactions.index')->with('success', 'Buku berhasil dibeli.');
    }

    // Tampilkan detail transaksi (hanya untuk pemiliknya)
    public function show(Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }

        return view('user.transactions.show', compact('transaction'));
    }

    // Hapus transaksi (misalnya pembatalan)
    public function destroy(Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }

        $transaction->delete();

        return redirect()->route('user.transactions.index')->with('success', 'Transaksi berhasil dibatalkan.');
    }
}
