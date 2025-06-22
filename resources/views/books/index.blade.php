@extends('layouts.usermaster')

@section('title', 'Daftar Buku')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">📚 Daftar Buku</h3>

    @if ($books->count())
        <div class="row">
            @foreach ($books as $book)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        @if ($book->cover_image)
                            <img src="{{ asset('storage/' . $book->cover_image) }}" class="card-img-top" alt="Cover Buku" style="height: 200px; object-fit: cover;">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text text-muted mb-1">Penulis: {{ $book->author->name }}</p>
                            <p class="card-text">{{ Str::limit($book->description, 80) }}</p>

                            <a href="{{ route('user.books.show', $book->id) }}" class="btn btn-sm btn-primary mt-auto">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center">
            {{ $books->links() }} {{-- Pagination --}}
        </div>
    @else
        <p class="text-muted">Belum ada buku yang tersedia.</p>
    @endif
</div>
@endsection
