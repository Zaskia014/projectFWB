@extends('layouts.masteruser')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">🛒 Keranjang Belanja</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(count($cart))
        <table class="table table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Judul Buku</th>
                    <th>Harga Satuan</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $grandTotal = 0; @endphp
                @foreach($books as $book)
                    @php
                        $jumlah = $cart[$book->id];
                        $total = $book->price * $jumlah;
                        $grandTotal += $total;
                    @endphp
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                @if ($book->cover_image)
                                    <img src="{{ asset('storage/' . $book->cover_image) }}" width="60" class="img-thumbnail me-2">
                                @endif
                                <span>{{ $book->title }}</span>
                            </div>
                        </td>
                        <td>Rp{{ number_format($book->price, 0, ',', '.') }}</td>
                        <td>{{ $jumlah }}</td>
                        <td>Rp{{ number_format($total, 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('user.cart.remove', $book->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus buku ini dari keranjang?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tr class="table-secondary">
                    <td colspan="3"><strong>Total Keseluruhan</strong></td>
                    <td colspan="2"><strong>Rp{{ number_format($grandTotal, 0, ',', '.') }}</strong></td>
                </tr>
            </tbody>
        </table>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('user.books.index') }}" class="btn btn-secondary">← Lanjut Belanja</a>

            <form action="{{ route('user.cart.checkout') }}" method="POST">
                @csrf
                <button class="btn btn-success">💳 Checkout Sekarang</button>
            </form>
        </div>
    @else
        <div class="alert alert-info">
            Keranjang belanja kamu kosong. Yuk cari buku dulu!
        </div>
        <a href="{{ route('user.books.index') }}" class="btn btn-primary">📚 Cari Buku</a>
    @endif
</div>
@endsection
