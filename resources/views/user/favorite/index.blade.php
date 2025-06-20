@extends('layouts.usermaster')

@section('title', 'Favorit Saya')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center">💖 Buku Favorit Saya</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if($favorites->isEmpty())
        <div class="alert alert-info text-center">
            Kamu belum menyukai buku apa pun. Yuk cari buku menarik di katalog!
            <br>
            <a href="{{ url('/dashboard') }}" class="btn btn-outline-primary mt-3">Kembali ke Beranda</a>
        </div>
    @else
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($favorites as $book)
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        @if($book->cover_image)
                            <img src="{{ asset('storage/' . $book->cover_image) }}" class="card-img-top" alt="Cover Buku" style="height: 300px; object-fit: cover;">
                        @else
                            <img src="https://via.placeholder.com/300x400?text=No+Cover" class="card-img-top" alt="No Cover">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text text-muted mb-2">
                                <i class="bi bi-tags"></i> {{ $book->category->name ?? 'Tanpa Kategori' }}
                            </p>
                            <div class="mt-auto">
                                <a href="{{ route('user.books.show', $book->id) }}" class="btn btn-outline-primary w-100">📖 Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
