@extends('layouts.usermaster')

@section('title', 'Buku Favoritku')

@section('content')
<div class="container">
    <h3 class="mb-4">Buku Favoritku</h3>

    @if ($favorites->isEmpty())
        <p class="text-muted">Kamu belum menambahkan buku favorit.</p>
    @else
        <div class="row">
            @foreach ($favorites as $book)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        @if($book->cover)
                            <img src="{{ asset('storage/' . $book->cover) }}" class="card-img-top" alt="Cover Buku">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text">{{ Str::limit($book->description, 100) }}</p>
                            <a href="{{ route('books.show', $book->id) }}" class="btn btn-primary btn-sm">Lihat Detail</a>
                            <form action="{{ route('favorites.destroy', $book->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm">💔 Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
