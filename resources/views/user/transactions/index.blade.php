@extends('layouts.usermaster')

@section('title', 'Transaksi Saya')

@section('content')
<div class="container mt-4">
    <h2>📄 Riwayat Transaksi</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if ($transactions->isEmpty())
        <div class="alert alert-info">Belum ada transaksi.</div>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Buku</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $tx)
                    <tr>
                        <td>{{ $tx->book->title }}</td>
                        <td>Rp {{ number_format($tx->total_price, 0, ',', '.') }}</td>
                        <td><span class="badge bg-success">{{ ucfirst($tx->status) }}</span></td>
                        <td>{{ $tx->transaction_date->format('d M Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
