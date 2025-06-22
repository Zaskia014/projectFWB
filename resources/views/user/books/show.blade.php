@extends('layouts.usermaster')

@section('title', $book->title)

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            @if ($book->cover_image)
                <img src="{{ asset('storage/' . $book->cover_image) }}" class="img-fluid rounded" alt="Cover Buku">
            @endif
        </div>
        <div class="col-md-8">
            <h2>{{ $book->title }}</h2>
            <p class="text-muted">Penulis: {{ $book->author->name }}</p>
            <p><strong>Kategori:</strong> {{ $book->category->name ?? '-' }}</p>
            <p>{{ $book->description }}</p>
            <p><strong>Harga:</strong> Rp{{ number_format($book->price, 0, ',', '.') }}</p>
            <p><strong>Rating:</strong> {{ number_format($book->averageRating(), 1) ?? '0.0' }} ⭐</p>

            @auth
                <div class="mt-3">
                    {{-- 💖 Favorite --}}
                    @if ($hasFavorited)
                        <form action="{{ route('user.favorites.destroy', $book->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger">💔 Hapus dari Favorit</button>
                        </form>
                    @else
                        <form action="{{ route('user.favorites.store', $book->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">💖 Tambah ke Favorit</button>
                        </form>
                    @endif

                    {{-- 🛒 Beli Buku --}}
                    @if (!$hasBought)
                        <form action="{{ route('user.transactions.store', $book->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-primary">🛒 Beli Buku</button>
                        </form>
                    @endif

                    {{-- ✍️ Tulis Ulasan --}}
                    @if ($hasBought && !$book->reviews->contains('user_id', auth()->id()))
                        <a href="{{ route('user.reviews.create', $book->id) }}" class="btn btn-success">✍️ Tulis Ulasan</a>
                    @endif
                </div>
            @endauth
        </div>
    </div>

    {{-- ULASAN --}}
    <div class="mt-5">
        <h4>Ulasan Pembaca</h4>
        @forelse ($book->reviews as $review)
            <div class="border rounded p-3 mb-3">
                <strong>{{ $review->user->name }}</strong> <span class="text-warning">({{ $review->rating }}⭐)</span>
                <p class="mb-1">{{ $review->review }}</p>

                {{-- Tampilkan tombol edit/hapus jika user adalah penulis review --}}
                @auth
                    @if ($review->user_id === auth()->id())
                        <a href="{{ route('user.reviews.edit', $review->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('user.reviews.destroy', $review->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus ulasan ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    @endif
                @endauth
            </div>
        @empty
            <p class="text-muted">Belum ada ulasan untuk buku ini.</p>
        @endforelse
    </div>
</div>
@endsection
