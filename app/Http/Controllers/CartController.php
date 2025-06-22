<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $books = Book::whereIn('id', array_keys($cart))->get();
        return view('user.cart.index', compact('books', 'cart'));
    }

    public function add(Book $book)
    {
        $cart = session()->get('cart', []);
        $cart[$book->id] = ($cart[$book->id] ?? 0) + 1;
        session()->put('cart', $cart);

        return redirect()->route('user.cart.index')->with('success', 'Buku berhasil ditambahkan ke keranjang.');
    }

    public function remove(Book $book)
    {
        $cart = session()->get('cart', []);
        unset($cart[$book->id]);
        session()->put('cart', $cart);

        return redirect()->route('user.cart.index')->with('success', 'Buku berhasil dihapus dari keranjang.');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        $user = auth()->user();

        if (empty($cart)) {
            return back()->with('error', 'Keranjang kosong.');
        }

        $books = Book::whereIn('id', array_keys($cart))->get();

        foreach ($books as $book) {
            Transaction::create([
                'user_id' => $user->id,
                'book_id' => $book->id,
                'status' => 'success',
                'total_price' => $book->price * $cart[$book->id],
                'transaction_date' => now(),
            ]);
        }

        session()->forget('cart');

        return redirect()->route('user.transactions.index')->with('success', 'Checkout berhasil!');
    }
}
