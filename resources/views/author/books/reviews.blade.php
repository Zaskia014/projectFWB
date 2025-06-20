@extends('layouts.authormaster')

@section('content')
<div class="container">
    <h3>📝 Ulasan Pengguna – <em>{{ $book->title }}</em></h3>
    <a href="{{ route('author.books.index') }}" class="btn btn-secondary mb-3">← Kembali ke Daftar Buku</a>

    @if($reviews->count())
        @foreach($reviews as $review)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $review->user->name }} 
                        <span class="badge bg-warning text-dark">{{ $review->rating }} ⭐</span>
                    </h5>
                    <p class="card-text">{{ $review->comment }}</p>
                    <small class="text-muted">Diulas pada {{ $review->created_at->format('d M Y, H:i') }}</small>
                </div>
            </div>
        @endforeach
    @else
        <div class="alert alert-info">
            Belum ada ulasan dari pengguna untuk buku ini.
        </div>
    @endif
</div>
@endsection
