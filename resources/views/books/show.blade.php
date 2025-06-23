@extends('layouts.masteruser')

@section('title', $book->title)

@section('content')
<div class="container mt-4">
    <div class="row">
        {{-- Gambar Buku --}}
        <div class="col-md-4">
            @if ($book->cover_image)
                <img src="{{ asset('storage/' . $book->cover_image) }}" class="img-fluid rounded shadow-sm" alt="Cover Buku">
            @endif
        </div>

        {{-- Detail Buku --}}
        <div class="col-md-8">
            <h2>{{ $book->title }}</h2>
            <p class="text-muted">Penulis: {{ $book->author->name }}</p>
            <p>Kategori: {{ $book->category->name ?? '-' }}</p>
            <p>{{ $book->description }}</p>

            {{-- Tombol Aksi --}}
            <div class="mt-3 d-flex flex-wrap gap-2">

                {{-- 💖 Tambah ke Favorit --}}
                @php
                    $sudahFavorit = auth()->check() && auth()->user()->hasFavorited($book);
                @endphp

                @auth
                    @if (!$sudahFavorit)
                        <form action="{{ route('user.favorites.store', $book->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-outline-danger btn-sm" type="submit">
                                💖 Tambahkan ke Favorit
                            </button>
                        </form>
                    @else
                        <span class="badge bg-danger align-self-center">❤️ Sudah Difavoritkan</span>
                    @endif

                    {{-- 🛒 Beli Buku --}}
                    <form action="{{ route('user.transactions.store', $book->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-outline-success btn-sm" type="submit">
                            🛒 Beli Buku
                        </button>
                    </form>

                    {{-- ✍️ Tulis Ulasan --}}
                    @if(auth()->user()->transactions()->where('book_id', $book->id)->exists() && !$book->reviews->where('user_id', auth()->id())->count())
                        <a href="{{ route('user.reviews.create', $book->id) }}" class="btn btn-outline-primary btn-sm">
                            ✍️ Tulis Ulasan
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </div>

    <hr class="my-4">

    {{-- Ulasan Buku --}}
    <div class="mt-4">
        <h4>Ulasan Pembaca</h4>

        @if ($book->reviews->count())
            @foreach ($book->reviews as $review)
                <div class="border rounded p-3 mb-3 bg-light">
                    <strong>{{ $review->user->name }}</strong>
                    <span class="text-warning">({{ $review->rating }} ★)</span>
                    <p class="mb-1">{{ $review->review }}</p>

                    {{-- Tampilkan tombol edit & hapus jika ini ulasan user sendiri --}}
                    @auth
                        @if($review->user_id === auth()->id())
                            <div class="mt-2">
                                <a href="{{ route('user.reviews.edit', $review->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('user.reviews.destroy', $review->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus ulasan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </div>
                        @endif
                    @endauth
                </div>
            @endforeach
        @else
            <p class="text-muted">Belum ada ulasan untuk buku ini.</p>
        @endif
    </div>
</div>
@endsection
