@extends('layouts.master')

@section('title', 'Edit Ulasan Buku')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Edit Ulasan Buku</h5>
        </div>
        <div class="card-body">

            {{-- Tampilkan error validasi --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong><i class="bi bi-exclamation-triangle me-1"></i>Terjadi kesalahan:</strong>
                    <ul class="mt-2 mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.reviews.update', $review->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="user_id" class="form-label">Pengguna</label>
                    <select name="user_id" id="user_id" class="form-select" required>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $review->user_id == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="book_id" class="form-label">Buku</label>
