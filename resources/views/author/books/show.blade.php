@extends('layouts.authormaster')

@section('content')
<div class="container">
    <h3>📖 Detail Buku</h3>
    <a href="{{ route('author.books.index') }}" class="btn btn-secondary mb-3">← Kembali</a>

    <div class="card shadow">
        <div class="row g-0">
            @if($book->cover_image)
                <div class="col-md-4">
                    <img src="{{ asset('storage/' . $book->cover_image) }}" class="img-fluid rounded-start" alt="cover buku">
                </div>
            @endif
            <div class="col-md-8">
                <div class="card-body">
                    <h4 class="card-title">{{ $book->title }}</h4>
                    
                    <p class="card-text"><strong>Kategori:</strong> {{ $book->category->name ?? '-' }}</p>
                    <p class="card-text"><strong>Harga:</strong> Rp{{ number_format($book->price, 0, ',', '.') }}</p>
                    <p class="card-text"><strong>Tanggal Terbit:</strong> {{ \Carbon\Carbon::parse($book->published_date)->format('d M Y') }}</p>
                    <p class="card-text"><strong>Deskripsi:</strong><br>{{ $book->description }}</p>

                    {{-- ✅ Tambahan info statistik --}}
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <p class="card-text"><strong>Total Pembelian:</strong> {{ $book->transactions->count() }} kali</p>
                        </div>
                        <div class="col-md-6">
                            <p class="card-text"><strong>Total Ulasan:</strong> {{ $book->reviews->count() }}</p>
                        </div>
                    </div>

                    <p class="card-text">
                        <small class="text-muted">Dibuat pada {{ $book->created_at->format('d M Y, H:i') }}</small>
                    </p>

                    <div class="mt-3 d-flex gap-2">
                        <a href="{{ route('author.books.reviews', $book->id) }}" class="btn btn-info">💬 Lihat Ulasan</a>
                        <a href="{{ route('author.books.edit', $book->id) }}" class="btn btn-warning">✏️ Edit Buku</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
