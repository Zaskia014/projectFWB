@extends('layouts.master')

@section('title', 'Tambah Transaksi')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Tambah Transaksi</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ups!</strong> Ada kesalahan saat input:
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.transactions.store') }}">
        @csrf

        <div class="mb-3">
            <label for="user_id" class="form-label">Nama Pengguna</label>
            <select name="user_id" class="form-control" required>
                <option value="">-- Pilih Pengguna --</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="book_id" class="form-label">Buku</label>
            <select name="book_id" class="form-control" required>
                <option value="">-- Pilih Buku --</option>
                @foreach ($books as $book)
                    <option value="{{ $book->id }}">{{ $book->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="transaction_date" class="form-label">Tanggal Transaksi</label>
            <input type="date" name="transaction_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="pending">Pending</option>
                <option value="completed">Completed</option>
                <option value="canceled">Canceled</option>
            </select>
        </div>

        <a href="{{ route('admin.transactions.index') }}" class="btn btn-secondary">Kembali</a>
        <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
    </form>
</div>
@endsection
