@extends('layouts.master')

@section('title', 'Edit Buku')

@section('content')
<div class="container my-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Edit Buku: <strong>{{ $book->title }}</strong></h5>
        </div>

        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Terjadi kesalahan!</strong>
                    <ul class="mb-0 mt-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="title" class="form-label">Judul Buku</label>
                        <input type="text" name="title" class="form-control" required value="{{ old('title', $book->title) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="price" class="form-label">Harga (Rp)</label>
                        <input type="number" name="price" class="form-control" required value="{{ old('price', $book->price) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="category_id" class="form-label">Kategori</label>
                        <select name="category_id" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="published_date" class="form-label">Tanggal Terbit</label>
                        <input type="date" name="published_date" class="form-control" value="{{ old('published_date', $book->published_date) }}">
                    </div>

                    <div class="col-12 mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="4" required>{{ old('description', $book->description) }}</textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="cover_image" class="form-label">Ganti Cover Buku <small class="text-muted">(Opsional)</small></label>
                        <input type="file" name="cover_image" class="form-control">
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah cover.</small>
                    </div>

                    @if ($book->cover_image)
                    <div class="col-md-6 mb-3">
                        <label class="form-label d-block">Cover Saat Ini</label>
                        <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover Buku" class="img-thumbnail" width="150">
                    </div>
                    @endif
                </div>

                <div class="text-end">
                    <a href="{{ route('admin.books.index') }}" class="btn btn-secondary me-2">
                        <i class="bi bi-arrow-left-circle"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save2"></i> Perbarui Buku
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
