@extends('layouts.usermaster')

@section('title', 'Tulis Ulasan')

@section('content')
<div class="container mt-4">
    <h3>Ulasan untuk: <strong>{{ $book->title }}</strong></h3>

    <form action="{{ route('reviews.store', $book->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="rating" class="form-label">Rating (1-5)</label>
            <select name="rating" id="rating" class="form-select">
                <option value="">Pilih rating</option>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>

        <div class="mb-3">
            <label for="review" class="form-label">Ulasan</label>
            <textarea name="review" id="review" class="form-control" rows="5" required></textarea>
        </div>

        <button type="submit" class="btn btn-success">Kirim Ulasan</button>
        <a href="{{ route('user.books.show', $book->id) }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
