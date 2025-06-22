@extends('layouts.usermaster')

@section('title', 'Tulis Ulasan')

@section('content')
<div class="container mt-4">
    <h2>Ulasan untuk Buku: <strong>{{ $book->title }}</strong></h2>

    <form method="POST" action="{{ route('user.reviews.store', $book->id) }}">
        @csrf

        <div class="mb-3">
            <label>Rating (1 - 5)</label>
            <input type="number" name="rating" class="form-control" min="1" max="5" required>
        </div>

        <div class="mb-3">
            <label>Ulasan</label>
            <textarea name="review" class="form-control" rows="4" required></textarea>
        </div>

        <a href="{{ route('user.books.show', $book->id) }}" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
    </form>
</div>
@endsection
