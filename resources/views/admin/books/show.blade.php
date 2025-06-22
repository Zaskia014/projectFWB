@extends('layouts.master')

@section('title', 'Detail Buku')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h4>Detail Buku: {{ $book->title }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Cover Buku -->
                <div class="col-md-4">
                    @if ($book->cover_image)
                        <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover Buku" class="img-fluid rounded">
                    @else
                        <img src="https://via.placeholder.com/300x400?text=No+Cover" alt="No Cover" class="img-fluid rounded">
                    @endif
                </div>

                <!-- Detail Buku -->
                <div class="col-md-8">
                    <table class="table table-borderless">
                        <tr>
                            <th>Judul</th>
                            <td>{{ $book->title }}</td>
                        </tr>
                        <tr>
                            <th>Penulis</th>
                            <td>{{ $book->author->name ?? 'Tidak diketahui' }}</td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <td>{{ $book->category->name ?? 'Tidak diketahui' }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Terbit</th>
                            <td>{{ \Carbon\Carbon::parse($book->published_date)->translatedFormat('d F Y') }}</td>
                        </tr>
                        <tr>
                            <th>Harga</th>
                            <td>Rp{{ number_format($book->price, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td>{{ $book->description }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="mt-3">
                <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">Kembali ke Daftar Buku</a>
            </div>
        </div>
    </div>
</div>
@endsection
