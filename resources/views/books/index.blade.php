@extends('layouts.usermaster')

@section('title', 'Daftar Buku')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Daftar Buku</h2>

    <div class="row">
        @foreach ($books as $book)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    @if($book->cover_image)
                        <img src="{{ asset('storage/' . $book->cover_image) }}" class="card-img-top" alt="{{ $book->title }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $book->title }}</h5>
                        <p class="card-text">Penulis: {{ $book->author->name }}</p>
                        <p class="card-text"><small class="text-muted">{{ $book->category->name }}</small></p>
                        <a href="{{ route('user.books.show', $book->id) }}" class="btn btn-sm btn-primary">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
