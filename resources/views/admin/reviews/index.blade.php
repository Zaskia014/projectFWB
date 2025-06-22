@extends('layouts.adminmaster')

@section('title', 'Daftar Ulasan Buku')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Daftar Ulasan Buku</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Pengulas</th>
                <th>Rating</th>
                <th>Komentar</th>
                <th>Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reviews as $index => $review)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $review->book->title ?? '-' }}</td>
                    <td>{{ $review->user->name ?? '-' }}</td>
                    <td>{{ $review->rating }}</td>
                    <td>{{ Str::limit($review->review, 50) }}</td>
                    <td>{{ $review->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('admin.reviews.edit', $review->id) }}" class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus ulasan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada ulasan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
