@extends('layouts.master')

@section('title', 'Tambah Buku')

@section('content')
<div class="container my-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Tambah Buku Baru</h5>
        </div>

        <div class="card-body">
            {{-- Menampilkan error validasi --}}
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

            <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="title" class="form-label">Judul Buku</label>
                        <input type="text" name="title" class="form-control" required value="{{ old('title') }}" placeholder="Masukkan judul buku">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="price" class="form-label">Harga (Rp)</label>
                        <input type="number" name="price" class="form-control" required value="{{ old('price') }}" placeholder="Contoh: 75000">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="category_id" class="form-label">Kategori</label>
                        <select name="category_id" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="author_id" class="form-label">Penulis</label>
                        <select name="author_id" class="form-select" required>
                            <option value="">-- Pilih Penulis --</option>
                            @foreach ($authors as $author)
                                <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>
                                    {{ $author->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="published_date" class="form-label">Tanggal Terbit</label>
                        <input type="date" name="published_date" class="form-control" required value="{{ old('published_date') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="cover_image" class="form-label">Cover Buku</label>
                        <input type="file" name="cover_image" class="form-control">
                        <small class="text-muted">Format gambar: JPG, PNG. Max 2MB.</small>
                    </div>

                    <div class="col-12 mb-3">
                        <label for="description" class="form-label">Deskripsi Buku</label>
                        <textarea name="description" class="form-control" rows="4" placeholder="Tulis deskripsi buku di sini..." required>{{ old('description') }}</textarea>
                    </div>
                </div>

                <div class="text-end">
                    <a href="{{ route('admin.books.index') }}" class="btn btn-secondary me-2">
                        <i class="bi bi-arrow-left-circle"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save2"></i> Simpan Buku
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
