@extends('layouts.master')
@section('title', 'Kategori')
@section('content')
<div class="container mt-4">
    <h2>Kategori Buku</h2>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-success mb-3">+ Tambah</a>
    <table class="table">
        <thead><tr><th>No</th><th>Nama</th><th>Aksi</th></tr></thead>
        <tbody>
            @foreach($categories as $i => $cat)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $cat->name }}</td>
                <td>
                    <a href="{{ route('admin.categories.edit', $cat->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" class="d-inline">@csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
