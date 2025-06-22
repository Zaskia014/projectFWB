<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Book;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user', 'book')->latest()->get();
        return view('admin.transactions.index', compact('transactions'));
    }

    public function create()
    {
        $users = User::all();
        $books = Book::all();
        return view('admin.transactions.create', compact('users', 'books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'          => 'required|exists:users,id',
            'book_id'          => 'required|exists:books,id',
            'transaction_date' => 'required|date',
            'status'           => 'required|in:pending,completed,canceled',
        ]);

        $book = Book::findOrFail($request->book_id);

        Transaction::create([
            'user_id'          => $request->user_id,
            'book_id'          => $book->id,
            'transaction_date' => $request->transaction_date,
            'status'           => $request->status,
            'total_price'      => $book->price,
        ]);

        return redirect()->route('admin.transactions.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function edit(Transaction $transaction)
    {
        $users = User::all();
        $books = Book::all();
        return view('admin.transactions.edit', compact('transaction', 'users', 'books'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'user_id'          => 'required|exists:users,id',
            'book_id'          => 'required|exists:books,id',
            'transaction_date' => 'required|date',
            'status'           => 'required|in:pending,completed,canceled',
        ]);

        $book = Book::findOrFail($request->book_id);

        $transaction->update([
            'user_id'          => $request->user_id,
            'book_id'          => $book->id,
            'transaction_date' => $request->transaction_date,
            'status'           => $request->status,
            'total_price'      => $book->price,
        ]);

        return redirect()->route('admin.transactions.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('admin.transactions.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
