@extends('layouts.usermaster')

@section('title', 'Detail Transaksi')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-primary">📖 Detail Transaksi</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="card-title">{{ $transaction->book->title }}</h4>
            <p class="card-text">
                <strong>Nama Pengguna:</strong> {{ $transaction->user->name }}<br>
                <strong>Status:</strong>
                <span class="badge bg-{{ 
                    $transaction->status === 'pending' ? 'warning' : 
                    ($transaction->status === 'canceled' ? 'danger' : 'success') 
                }}">
                    {{ ucfirst($transaction->status) }}
                </span><br>
                <strong>Tanggal Transaksi:</strong> {{ $transaction->formatted_date }}<br>
                <strong>Harga:</strong> Rp{{ number_format($transaction->price, 0, ',', '.') }}
            </p>

            <div class="mt-4">
                <a href="{{ route('user.transactions.index') }}" class="btn btn-secondary">← Kembali ke Riwayat</a>
            </div>
        </div>
    </div>
</div>
@endsection
