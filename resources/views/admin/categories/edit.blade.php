@extends('layouts.master')
@section('title', 'Tambah Kategori')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="bi bi-folder-plus me-2"></i>Tambah Kategori Baru</h4>
        </div>
        <div class="card-body">

            {{-- Tampilkan pesan error validasi --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Terjadi Kesalahan!</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.categories.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Kategori</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Contoh: Fiksi, Non-Fiksi" value="{{ old('name') }}" required>
                </div>
                <div class="text-end">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary me-2"><i class="bi bi-arrow-left"></i> Batal</a>
                    <button class="btn btn-success"><i class="bi bi-check-circle"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
