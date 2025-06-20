@extends('layouts.usermaster')

@section('title', $book->title)

@section('content')
<div class="container">
    <h2>{{ $book->title }}</h2>
    <p class="text-muted">Kategori: {{ $book->category->name ?? '-' }} | Ditulis oleh: {{ $book->author->name }}</p>
    <p>{{ $book->description }}</p>

    <hr>
    <h5>Ulasan</h5>
    @foreach($book->reviews as $review)
        <div class="mb-2">
            <strong>{{ $review->user->name }}</strong> memberi rating: <strong>{{ $review->rating }}/5</strong><br>
            <p>{{ $review->comment }}</p>
        </div>
    @endforeach

    @auth
        {{-- <a href="{{ route('reviews.create', $book->id) }}" class="btn btn-primary btn-sm">+ Tulis Review</a> --}}
    @endauth
</div>
@endsection
