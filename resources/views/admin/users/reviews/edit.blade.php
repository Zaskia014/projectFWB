@extends('layouts.user')
@section('title', 'Edit Ulasan')

@section('content')
<div class="container">
    <h3>Edit Ulasan untuk Buku ID: {{ $review->book_id }}</h3>

    <form action="{{ route('reviews.update', $review->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Rating</label>
            <input type="number" name="rating" class="form-control" value="{{ $review->rating }}" min="1" max="5" required>
        </div>
        <div class="mb-3">
            <label>Ulasan</label>
            <textarea name="review" class="form-control" required>{{ $review->review }}</textarea>
        </div>
        <button class="btn btn-success">Perbarui</button>
    </form>
</div>
@endsection
