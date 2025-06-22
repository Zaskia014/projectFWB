@extends('layouts.usermaster')

@section('title', 'Edit Profil')

@section('content')
<div class="container mt-4">
    <h1>Edit Profil</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('user.profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Password Baru (kosongkan jika tidak ingin ganti)</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a href="{{ route('user.profile.show') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
