@extends('layouts.master')

@section('title', 'Edit Transaksi')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit Transaksi</h2>

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

    <form method="POST" action="{{ route('admin.transactions.update', $transaction->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="user_id" class="form-label">Nama Pengguna</label>
            <select name="user_id" class="form-control" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $transaction->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="book_id" class="form-label">Buku</label>
            <select name="book_id" class="form-control" required>
                @foreach ($books as $book)
                    <option value="{{ $book->id }}" {{ $transaction->book_id == $book->id ? 'selected' : '' }}>
                        {{ $book->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="transaction_date" class="form-label">Tanggal Transaksi</label>
            <input type="date" name="transaction_date" class="form-control" value="{{ $transaction->transaction_date }}" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="pending" {{ $transaction->status === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="completed" {{ $transaction->status === 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="canceled" {{ $transaction->status === 'canceled' ? 'selected' : '' }}>Canceled</option>
            </select>
        </div>

        <a href="{{ route('admin.transactions.index') }}" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">Update Transaksi</button>
    </form>
</div>
@endsection
