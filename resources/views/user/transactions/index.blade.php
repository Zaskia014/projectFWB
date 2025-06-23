@extends('layouts.masteruser')

@section('title', 'Riwayat Transaksi')

@section('content')
<div class="container mt-5">
    <h3 class="mb-4">🧾 Riwayat Transaksi</h3>

    {{-- Pesan flash --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Daftar Transaksi --}}
    @forelse ($transactions as $trx)
        <div class="card mb-3 shadow-sm border-0">
            <div class="card-body">
                <h5 class="card-title">{{ $trx->book->title }}</h5>
                <p class="mb-1"><strong>Harga:</strong> Rp{{ number_format($trx->price, 0, ',', '.') }}</p>
                <p class="mb-1"><strong>Status:</strong> 
                    <span class="badge bg-{{ 
                        $trx->status === 'success' ? 'success' : 
                        ($trx->status === 'canceled' ? 'danger' : 'secondary') 
                    }}">
                        {{ ucfirst($trx->status) }}
                    </span>
                </p>
                <p class="mb-3"><strong>Tanggal:</strong> {{ $trx->formatted_date }}</p>

                <a href="{{ route('user.books.show', $trx->book->id) }}" class="btn btn-sm btn-outline-primary">
                    📖 Lihat Buku
                </a>

                {{-- Batalkan transaksi jika belum sukses atau belum dibatalkan --}}
                @if($trx->status !== 'success' && $trx->status !== 'canceled')
                    <form action="{{ route('user.user.transactions.index', $trx->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin membatalkan transaksi ini?')">
                            ❌ Batalkan
                        </button>
                    </form>
                @endif

                {{-- Form Ulasan Buku jika transaksi sukses dan user belum pernah mengulas --}}
                @if($trx->status === 'success' && !$trx->book->reviews->where('user_id', auth()->id())->count())
                    <hr>
                    <form action="{{ route('user.reviews.store') }}" method="POST" class="mt-2">
                        @csrf
                        <input type="hidden" name="book_id" value="{{ $trx->book->id }}">

                        <div class="mb-2">
                            <label for="review" class="form-label">Ulasan:</label>
                            <textarea name="review" class="form-control" rows="2" required></textarea>
                        </div>

                        <div class="mb-2">
                            <label for="rating" class="form-label">Rating:</label>
                            <select name="rating" class="form-select" required>
                                <option value="">Pilih Rating</option>
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}">{{ $i }} ⭐</option>
                                @endfor
                            </select>
                        </div>

                        <button type="submit" class="btn btn-sm btn-success">✅ Kirim Ulasan</button>
                    </form>
                @elseif($trx->book->reviews->where('user_id', auth()->id())->count())
                    <p class="text-muted mt-2">✅ Kamu sudah mengulas buku ini.</p>
                @endif
            </div>
        </div>
    @empty
        <div class="alert alert-info">Belum ada transaksi yang tercatat.</div>
    @endforelse

    {{-- Navigasi halaman --}}
    <div class="mt-4">
        {{ $transactions->links() }}
    </div>
</div>
@endsection
