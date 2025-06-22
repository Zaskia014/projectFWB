@extends('layouts.master')

@section('title', $book->title)

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            @if ($book->cover_image)
                <img src="{{ asset('storage/' . $book->cover_image) }}" class="img-fluid rounded" alt="Cover Buku">
            @else
                <img src="https://via.placeholder.com/300x400?text=No+Cover" class="img-fluid rounded" alt="No Cover">
            @endif
        </div>
        <div class="col-md-8">
            <h2>{{ $book->title }}</h2>
            <p><strong>Penulis:</strong> {{ $book->author->name }}</p>
            <p><strong>Kategori:</strong> {{ $book->category->name }}</p>
            <p><strong>Tanggal Terbit:</strong> {{ \Carbon\Carbon::parse($book->published_date)->format('d M Y') }}</p>
            <p><strong>Harga:</strong> Rp{{ number_format($book->price, 0, ',', '.') }}</p>
            <p>{{ $book->description }}</p>
            <p><strong>Rata-rata Rating:</strong> {{ number_format($book->averageRating(), 1) }}/5</p>
        </div>
    </div>

    <hr>
    <h4>Ulasan Pengguna</h4>
    @if ($book->reviews->count())
        @foreach ($book->reviews as $review)
            <div class="card mb-3">
                <div class="card-body">
                    <strong>{{ $review->user->name }}</strong>
                    <span class="text-warning">
                        {!! str_repeat('★', $review->rating) !!}{!! str_repeat('☆', 5 - $review->rating) !!}
                    </span>
                    <p>{{ $review->review }}</p>
                </div>
            </div>
        @endforeach
    @else
        <p>Belum ada ulasan untuk buku ini.</p>
    @endif

    <hr>
    <h5>Beli Buku</h5>

    @auth
        @php
            $user = auth()->user();
            $hasBought = $book->transactions->where('user_id', $user->id)->count() > 0;
            $hasReviewed = $book->reviews->where('user_id', $user->id)->count() > 0;
        @endphp

        @if (!$hasBought)
            <form action="{{ route('user.transactions.store', $book->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success mb-3">Beli Buku Ini</button>
            </form>
        @else
            <div class="alert alert-success">
                Kamu sudah membeli buku ini.
            </div>
        @endif

        <hr>
        <h5>Berikan Ulasanmu</h5>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if ($hasBought)
            @if (!$hasReviewed)
                <form action="{{ route('user.reviews.store', $book->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating (1–5)</label>
                        <select name="rating" class="form-select" required>
                            <option value="">Pilih Rating</option>
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}">{{ $i }} Bintang</option>
                            @endfor
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="review" class="form-label">Komentar</label>
                        <textarea name="review" class="form-control" rows="3" placeholder="Tulis ulasanmu di sini..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
                </form>
            @else
                <div class="alert alert-info mt-2">
                    Kamu sudah mengulas buku ini.
                </div>
            @endif
        @else
            <div class="alert alert-warning mt-2">
                Hanya pembeli buku ini yang dapat memberikan ulasan.
            </div>
        @endif
    @else
        <p>Silakan <a href="{{ route('login') }}">login</a> untuk membeli dan memberikan ulasan.</p>
    @endauth
</div>
@endsection
