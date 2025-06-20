<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AuthorBookController extends Controller
{
    // 📄 Daftar semua buku milik Author
    public function index()
    {
        $books = Book::where('author_id', Auth::id())->latest()->get();
        return view('author.books.index', compact('books'));
    }

    // ➕ Form tambah buku
    public function create()
    {
        $categories = Category::all();
        return view('author.books.create', compact('categories'));
    }

    // 💾 Simpan buku baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'cover' => 'nullable|image|max:2048',
            'published_date' => 'nullable|date',
        ]);

        if ($request->hasFile('cover')) {
            $validated['cover_image'] = $request->file('cover')->store('covers', 'public');
        }

        $validated['author_id'] = Auth::id();

        Book::create($validated);

        return redirect()->route('author.books.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    // 🔍 Detail buku
    public function show(Book $book)
    {
        $this->authorizeBook($book);
        return view('author.books.show', compact('book'));
    }

    // ✏️ Form edit buku
    public function edit(Book $book)
    {
        $this->authorizeBook($book);
        $categories = Category::all();
        return view('author.books.edit', compact('book', 'categories'));
    }

    // 💾 Update buku
    public function update(Request $request, Book $book)
    {
        $this->authorizeBook($book);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'cover' => 'nullable|image|max:2048',
            'published_date' => 'nullable|date',
        ]);

        if ($request->hasFile('cover')) {
            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }
            $validated['cover_image'] = $request->file('cover')->store('covers', 'public');
        }

        $book->update($validated);

        return redirect()->route('author.books.index')->with('success', 'Buku berhasil diperbarui.');
    }

    // 🗑️ Hapus buku
    public function destroy(Book $book)
    {
        $this->authorizeBook($book);

        if ($book->cover_image) {
            Storage::disk('public')->delete($book->cover_image);
        }

        $book->delete();

        return redirect()->route('author.books.index')->with('success', 'Buku berhasil dihapus.');
    }

    // ⭐ Tampilkan review dari user
    public function showReviews(Book $book)
    {
        $this->authorizeBook($book);

        $reviews = $book->reviews()->with('user')->latest()->get();

        return view('author.books.reviews', compact('book', 'reviews'));
    }

    // 🔒 Validasi bahwa buku milik author yang sedang login
    protected function authorizeBook(Book $book)
    {
        if ($book->author_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }
    }
}
