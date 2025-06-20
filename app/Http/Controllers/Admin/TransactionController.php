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
        $users = \App\Models\User::all();
        $books = \App\Models\Book::all();
        return view('admin.transactions.create', compact('users', 'books'));
    }

   public function store(Request $request)
{
    $request->validate([
        'user_id'           => 'required|exists:users,id',
        'book_id'           => 'required|exists:books,id',
        'transaction_date'  => 'required|date',
        'status'            => 'required|in:pending,completed,canceled',
    ]);

    // Ambil harga buku
    $book = \App\Models\Book::findOrFail($request->book_id);

    // Simpan transaksi
    \App\Models\Transaction::create([
        'user_id'          => $request->user_id,
        'book_id'          => $request->book_id,
        'transaction_date' => $request->transaction_date,
        'status'           => $request->status,
        'total_price'      => $book->price,
    ]);

    return redirect()->route('admin.transactions.index')->with('success', 'Transaksi berhasil ditambahkan.');
}

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('admin.transactions.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
