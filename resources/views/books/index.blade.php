@extends('layouts.authormaster')

@section('title', 'Daftar Buku')

@section('content')
<div class="container">
    <h3 class="mb-4">Daftar Buku</h3>

    @auth
        @if(auth()->user()->role === 'author' || auth()->user()->role === 'admin')
            <a href="{{ route('books.create') }}" class="btn btn-primary mb-3">+ Tambah Buku</a>
        @endif
    @endauth

    @if($books->count())
        <div class="row">
            @foreach ($books as $book)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        @if($book->cover)
                            <img src="{{ asset('storage/' . $book->cover) }}" class="card-img-top" alt="Cover Buku">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text">{{ Str::limit($book->description, 100) }}</p>
                            {{-- <a href="{{ route('books.show', $book->id) }}" class="btn btn-sm btn-primary">Detail</a> --}}

                            @auth
                                @if(auth()->user()->id === $book->author_id || auth()->user()->role === 'admin')
                                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus buku ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{ $books->links() }} <!-- Pagination -->
    @else
        <p class="text-muted">Belum ada buku yang tersedia.</p>
    @endif
</div>
@endsection
