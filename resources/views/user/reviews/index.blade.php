@extends('layouts.masteruser')

@section('title', 'Daftar Review Buku')

@section('content')
<div class="py-3">
    <h1 class="mb-4">Daftar Semua Review Buku</h1>

    @if($reviews->count())
    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Buku</th>
                    <th>Reviewer</th>
                    <th>Rating</th>
                    <th>Komentar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reviews as $index => $review)
                <tr>
                    <td>{{ $reviews->firstItem() + $index }}</td>
                    <td>{{ $review->book->title }}</td>
                    <td>{{ $review->user->name }}</td>
                    <td>{{ $review->rating }}</td>
                    <td>{{ $review->comment ?? '-' }}</td>
                    <td>
                        <a href="{{ route('user.reviews.edit', $review->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('user.reviews.destroy', $review->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus review ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $reviews->links() }}
    @else
    <div class="alert alert-info">Belum ada review.</div>
    @endif
</div>
@endsection
