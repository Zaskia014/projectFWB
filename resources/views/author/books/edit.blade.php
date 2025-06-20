@extends('layouts.authormaster')

@section('content')
<div class="container">
    <h3>✏️ Edit Buku</h3>
    <a href="{{ route('author.books.index') }}" class="btn btn-secondary mb-3">← Kembali</a>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('author.books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Judul Buku</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $book->title) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select name="category_id" class="form-select" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" rows="4" class="form-control">{{ old('description', $book->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Ganti Cover (opsional)</label>
            <input type="file" name="cover" class="form-control">
            @if($book->cover_image)
                <small>Cover saat ini:</small><br>
                <img src="{{ asset('storage/' . $book->cover_image) }}" width="100" class="mt-2">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Perbarui Buku</button>
    </form>
</div>
@endsection
