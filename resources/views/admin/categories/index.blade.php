@extends('layouts.master')

@section('title', 'Kategori Buku')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold text-primary"><i class="bi bi-folder2-open me-2"></i>Kategori Buku</h2>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle me-1"></i> Tambah Kategori
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width: 5%">#</th>
                        <th>Nama Kategori</th>
                        <th style="width: 20%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $i => $cat)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $cat->name }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.categories.edit', $cat->id) }}" class="btn btn-warning btn-sm me-1">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.categories.destroy', $cat->id) }}"
