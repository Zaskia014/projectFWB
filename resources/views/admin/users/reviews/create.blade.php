@extends('layouts.user') {{-- layout untuk user --}}
@section('title', 'Tulis Ulasan')

@section('content')
<div class="container">
    <h3>Tulis Ulasan untuk: {{ $book->title }}</h3>

    <form action="{{ route('reviews.store', $book->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Rating (1–5)</label>
            <input type="number" name="rating" class="form-control" required min="1" max="5">
        </div>
        <div class="mb-3">
            <label>Ulasan</label>
            <textarea name="review" class="form-control" required></textarea>
        </div>
        <button class="btn btn-primary">Kirim Ulasan</button>
    </form>
</div>
@endsection
