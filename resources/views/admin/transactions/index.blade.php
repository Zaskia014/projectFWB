@extends('layouts.master')

@section('title', 'Daftar Transaksi')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">Daftar Transaksi</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.transactions.create') }}" class="btn btn-success mb-3">+ Tambah Transaksi</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>User</th>
                <th>Buku</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $trx)
            <tr>
                <td>{{ $trx->user->name }}</td>
                <td>{{ $trx->book->title }}</td>
                <td>{{ $trx->transaction_date }}</td>
                <td>{{ ucfirst($trx->status) }}</td>
                <td>Rp {{ number_format($trx->total_price, 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('admin.transactions.edit', $trx->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.transactions.destroy', $trx->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
