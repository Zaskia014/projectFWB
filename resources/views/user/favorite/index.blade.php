@extends('layouts.usermaster')

@section('title', 'Buku Favorit')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Buku Favorit Saya</h3>

    @if ($favorites->count())
        <div class="row">
            @foreach ($favorites as $fav)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        @if ($fav->book->cover_image)
                            <img src="{{ asset('storage/' . $fav->book->cover_image) }}" class="card-img-top" alt="Cover Buku" style="height: 200px; object-fit: cover;">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $fav->book->title }}</h5>
                            <p class="card-text">{{ Str::limit($fav->book->description, 100) }}</p>

                            <a href="{{ route('user.books.show', $fav->book->id) }}" class="btn btn-sm btn-primary mb-2">Detail</a>
                            <form action="{{ route('user.favorites.destroy', $fav->book->id) }}" method="POST" onsubmit="return confirm('Hapus dari favorit?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger w-100">Hapus dari Favorit</button>
                        </form>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-muted">Belum ada buku favorit.</p>
    @endif
</div>
@endsection
