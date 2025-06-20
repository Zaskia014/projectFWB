@extends('layouts.master')

@section('title', 'Kelola Transaksi')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">Daftar Transaksi</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.transactions.create') }}" class="btn btn-primary mb-3">➕ Tambah Transaksi</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Pengguna</th>
                <th>Judul Buku</th>
                <th>Tanggal Transaksi</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $i => $transaction)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $transaction->user->name }}</td>
                    <td>{{ $transaction->book->title }}</td>
                    <td>{{ $transaction->transaction_date }}</td>
                    <td>{{ ucfirst($transaction->status) }}</td>
                    <td>
                        <a href="{{ route('admin.transactions.edit', $transaction->id) }}" class="btn btn-sm btn-warning">✏️ Edit</a>
                        <form action="{{ route('admin.transactions.destroy', $transaction->id) }}" method="POST" style="display:inline-block;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus transaksi ini?')">🗑️ Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
