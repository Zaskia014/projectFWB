<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('user_id', Auth::id())->with('book')->get();
        return view('user.transactions.index', compact('transactions'));
    }

    public function create()
    {
        $books = Book::all();
        return view('user.transactions.create', compact('books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        Transaction::create([
            'user_id' => Auth::id(),
            'book_id' => $request->book_id,
            'status' => 'pending', // atau sesuai kebutuhan
        ]);

        return redirect()->route('user.transactions.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function show(Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) abort(403);
        return view('user.transactions.show', compact('transaction'));
    }

    public function edit(Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) abort(403);
        $books = Book::all();
        return view('user.transactions.edit', compact('transaction', 'books'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) abort(403);

        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $transaction->update([
            'book_id' => $request->book_id,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy(Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) abort(403);
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
