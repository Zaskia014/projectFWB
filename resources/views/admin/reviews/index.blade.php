@extends('layouts.master')

@section('title', 'Kelola Ulasan Buku')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">Kelola Ulasan Buku</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>User</th>
                <th>Buku</th>
                <th>Rating</th>
                <th>Ulasan</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reviews as $review)
            <tr>
                <td>{{ $review->user->name }}</td>
                <td>{{ $review->book->title }}</td>
                <td>{{ $review->rating }}</td>
                <td>{{ $review->review }}</td>
                <td>{{ $review->created_at->format('d M Y') }}</td>
                <td>
                    <a href="{{ route('admin.reviews.edit', $review->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('admin.reviews.show', $review->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus ulasan ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6">Belum ada ulasan.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
