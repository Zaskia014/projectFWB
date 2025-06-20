@extends('layouts.master')

@section('title', 'Edit Ulasan Buku')

@section('content')
<div class="container mt-4">
    <h2>Edit Ulasan Buku</h2>

    <form method="POST" action="{{ route('admin.reviews.update', $review->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="user_id">User</label>
            <select name="user_id" class="form-control" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $review->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="book_id">Buku</label>
            <select name="book_id" class="form-control" required>
                @foreach($books as $book)
                    <option value="{{ $book->id }}" {{ $review->book_id == $book->id ? 'selected' : '' }}>
                        {{ $book->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="rating">Rating</label>
            <input type="number" name="rating" value="{{ $review->rating }}" min="1" max="5" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="review">Ulasan</label>
            <textarea name="review" rows="3" class="form-control">{{ $review->review }}</textarea>
        </div>

        <button class="btn btn-success">Simpan Perubahan</button>
    </form>
</div>
@endsection
