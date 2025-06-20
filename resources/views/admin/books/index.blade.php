@extends('layouts.master') {{-- Gunakan layout admin yang sudah kamu buat --}}

@section('title', 'Kelola Buku')

@section('content')
<div class="container my-4">
    <h1 class="mb-4"><i class="bi bi-journals me-2"></i>Daftar Buku</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    <div class="mb-3 text-end">
        <a href="{{ route('admin.books.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Buku
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle table-bordered">
                    <thead class="table-light">
                        <tr class="text-center">
                            <th style="width: 5%;">#</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Penulis</th>
                            <th style="width: 20%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($books as $index => $book)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->category->name ?? '-' }}</td>
                                <td>Rp{{ number_format($book->price, 0, ',', '.') }}</td>
                                <td>{{ $book->author->name ?? '-' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.books.show', $book->id) }}" class="btn btn-info btn-sm me-1">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                    <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-warning btn-sm me-1">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Belum ada data buku.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
