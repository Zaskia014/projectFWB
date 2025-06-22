@extends('layouts.master')

@section('title', 'Riwayat Transaksi')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Riwayat Transaksi Anda</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($transactions->isEmpty())
        <p class="text-muted">Belum ada transaksi.</p>
        <a href="{{ route('user.books.index') }}" class="btn btn-primary">Beli Buku Sekarang</a>
    @else
        @foreach($transactions as $transaction)
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between">
                    <strong>Transaksi #{{ $transaction->id }}</strong>
                    <span class="text-muted">{{ $transaction->transaction_date->format('d M Y, H:i') }}</span>
                </div>
                <div class="card-body">
                    <p>Status: <span class="badge bg-info">{{ ucfirst($transaction->status) }}</span></p>
                    <p>Total: <strong>Rp{{ number_format($transaction->total_price, 0, ',', '.') }}</strong></p>

                    <h6 class="mt-3">Daftar Buku:</h6>
                    <ul>
                        @foreach ($transaction->books as $book)
                            <li>
                                <strong>{{ $book->title }}</strong> -
                                Qty: {{ $book->pivot->quantity }},
                                Harga: Rp{{ number_format($book->pivot->price, 0, ',', '.') }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
