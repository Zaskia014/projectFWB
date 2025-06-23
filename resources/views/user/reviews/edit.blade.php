@extends('layouts.masteruser')

@section('title', 'Edit Ulasan')

@section('content')
<div class="container mt-4">
    <h2>Edit Ulasan Buku</h2>

    <form method="POST" action="{{ route('user.reviews.update', $review->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Rating (1 - 5)</label>
            <input type="number" name="rating" class="form-control" value="{{ $review->rating }}" min="1" max="5" required>
        </div>

        <div class="mb-3">
            <label>Ulasan</label>
            <textarea name="review" class="form-control" rows="4" required>{{ $review->review }}</textarea>
        </div>

        <a href="{{ route('user.books.show', $review->book_id) }}" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-success">Update Ulasan</button>
    </form>
</div>
@endsection
