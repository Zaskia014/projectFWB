<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('book')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('user.transactions.index', compact('transactions'));
    }

    public function store(Book $book)
    {
        $user = Auth::user();

        // Cek jika user sudah beli buku ini
        if (Transaction::where('user_id', $user->id)->where('book_id', $book->id)->exists()) {
            return back()->with('error', 'Kamu sudah membeli buku ini.');
        }

        Transaction::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'price' => $book->price,
            'status' => 'success',
            'transaction_date' => now(),
        ]);

        return redirect()->route('user.transactions.index')->with('success', 'Pembelian berhasil!');
    }
}
