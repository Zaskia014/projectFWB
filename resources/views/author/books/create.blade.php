@extends('layouts.authormaster')

@section('title', 'Tambah Buku')

@section('content')

<div class="container">
    <h3>➕ Tambah Buku Baru</h3>
    <a href="{{ route('author.books.index') }}" class="btn btn-secondary mb-3">← Kembali</a>

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('author.books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Judul Buku</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select name="category_id" class="form-select" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" rows="4" class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Upload Cover (opsional)</label>
            <input type="file" name="cover" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Harga Buku</label>
            <input type="number" name="price" class="form-control" value="{{ old('price') }}" min="0" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan Buku</button>
    </form>
</div>
@endsection
