@extends('layouts.adminmaster')

@section('title', 'Edit Ulasan Buku')

@section('content')
<div class="container mt-4">
    <h2>Edit Ulasan Buku</h2>

    <form action="{{ route('admin.reviews.update', $review->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="book_id" class="form-label">Judul Buku</label>
            <select name="book_id" class="form-select" required>
                @foreach ($books as $book)
                    <option value="{{ $book->id }}" {{ $review->book_id == $book->id ? 'selected' : '' }}>
                        {{ $book->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="user_id" class="form-label">Nama Pengulas</label>
            <select name="user_id" class="form-select" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $review->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="rating" class="form-label">Rating (1-5)</label>
            <input type="number" name="rating" class="form-control" value="{{ old('rating', $review->rating) }}" min="1" max="5" required>
        </div>

        <div class="mb-3">
            <label for="review" class="form-label">Komentar</label>
            <textarea name="review" class="form-control" rows="4">{{ old('review', $review->review) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Ulasan</button>
        <a href="{{ route('admin.reviews.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
