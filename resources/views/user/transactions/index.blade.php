@extends('layouts.usermaster')

@section('title', 'Riwayat Transaksi')

@section('content')
<div class="container mt-5">
    <h3>🧾 Riwayat Transaksi</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @forelse ($transactions as $trx)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">{{ $trx->book->title }}</h5>
                <p class="mb-1"><strong>Harga:</strong> Rp{{ number_format($trx->price, 0, ',', '.') }}</p>
                <p class="mb-1"><strong>Status:</strong> 
                    <span class="badge bg-{{ $trx->status === 'success' ? 'success' : 'secondary' }}">
                        {{ ucfirst($trx->status) }}
                    </span>
                </p>
                <p class="mb-0"><strong>Tanggal:</strong> {{ $trx->formatted_date }}</p>
            </div>
        </div>
    @empty
        <div class="alert alert-info">Belum ada transaksi yang tercatat.</div>
    @endforelse

    <div class="mt-4">
        {{ $transactions->links() }}
    </div>
</div>
@endsection
