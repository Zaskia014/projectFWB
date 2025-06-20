@extends('layouts.master')

@section('title', 'Detail Ulasan Buku')

@section('content')
<div class="container mt-4">
    <h2>Detail Ulasan Buku</h2>

    <div class="card">
        <div class="card-body">
            <h5><strong>Nama Pengguna:</strong> {{ $review->user->name }}</h5>
            <p><strong>Judul Buku:</strong> {{ $review->book->title }}</p>
            <p><strong>Rating:</strong> {{ $review->rating }} / 5</p>
            <p><strong>Ulasan:</strong></p>
            <p>{{ $review->review ?? '-' }}</p>
            <p><strong>Tanggal Dibuat:</strong> {{ $review->created_at->format('d M Y H:i') }}</p>
            <p><strong>Terakhir Diperbarui:</strong> {{ $review->updated_at->format('d M Y H:i') }}</p>

            <a href="{{ route('admin.reviews.index') }}" class="btn btn-secondary mt-3">← Kembali</a>
        </div>
    </div>
</div>
@endsection
