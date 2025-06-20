@extends('layouts.master')

@section('title', 'Edit Buku')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-body">
            <h4 class="mb-4">Edit Buku: {{ $book->title }}</h4>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.books.update', $book->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Judul Buku</label>
                    <input type="text" name="title" class="form-control" required value="{{ old('title', $book->title) }}">
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label">Kategori</label>
                    <select name="category_id" class="form-select" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Harga</label>
                    <input type="number" name="price" class="form-control" required value="{{ old('price', $book->price) }}">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="4" required>{{ old('description', $book->description) }}</textarea>
                </div>

                <div class="text-end">
                    <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-success">Perbarui</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
