@extends('layouts.master')

@section('title', isset($book) ? 'Edit Buku' : 'Tambah Buku')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">{{ isset($book) ? 'Edit Buku' : 'Tambah Buku' }}</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ups!</strong> Ada kesalahan saat input:<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form 
        action="{{ isset($book) ? route('author.books.update', $book->id) : route('author.books.store') }}" 
        method="POST" 
        enctype="multipart/form-data"
    >
        @csrf
        @if (isset($book))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="title" class="form-label">Judul Buku</label>
            <input type="text" name="title" class="form-control" 
                value="{{ old('title', $book->title ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Kategori</label>
            <select name="category_id" class="form-select" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id', $book->category_id ?? '') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" rows="5">{{ old('description', $book->description ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="cover" class="form-label">Cover Buku</label>
            <input type="file" name="cover" class="form-control">
            @if (isset($book) && $book->cover_image)
                <img src="{{ asset('storage/' . $book->cover_image) }}" 
                     class="img-thumbnail mt-2" width="120">
            @endif
        </div>

        <div class="mb-3">
            <label for="published_date" class="form-label">Tanggal Terbit</label>
            <input type="date" name="published_date" class="form-control"
                value="{{ old('published_date', isset($book->published_date) ? $book->published_date->format('Y-m-d') : '') }}">
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Harga Buku</label>
            <input type="number" name="price" class="form-control" 
                value="{{ old('price', $book->price ?? '') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">{{ isset($book) ? 'Update' : 'Simpan' }}</button>
        <a href="{{ route('author.books.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
