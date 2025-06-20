@extends('layouts.authormaster')

@section('content')
<div class="container mt-4">
    <h3>📚 Daftar Buku Saya</h3>
    <a href="{{ route('author.books.create') }}" class="btn btn-primary mb-3">➕ Tambah Buku</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($books->count())
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Cover</th>
                    <th>Review</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->category->name ?? '-' }}</td>
                        <td>
                            @if($book->cover_image)
                                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="cover" width="60">
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            {{ $book->reviews->count() }} ulasan
                            <br>
                            <a href="{{ route('author.books.reviews', $book->id) }}" class="btn btn-sm btn-info mt-1">Lihat Review</a>
                        </td>
                        <td>
                            <a href="{{ route('author.books.show', $book->id) }}" class="btn btn-sm btn-success">Detail</a>
                            <a href="{{ route('author.books.edit', $book->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('author.books.destroy', $book->id) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Yakin ingin hapus buku ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Belum ada buku. Yuk tambah buku sekarang!</p>
    @endif
</div>
@endsection
