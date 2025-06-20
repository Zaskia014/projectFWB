@extends('layouts.master')
@section('title', 'Tambah Kategori')
@section('content')
<div class="container mt-4">
    <h2>Tambah Kategori</h2>
    <form method="POST" action="{{ route('admin.categories.store') }}">@csrf
        <div class="mb-3">
            <label>Nama Kategori</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
