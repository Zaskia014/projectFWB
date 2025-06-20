@extends('layouts.master')

@section('title', 'Profil Saya')

@section('content')
<div class="container mt-4">
    <h1>Profil Saya</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <p><strong>Nama:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>

    <a href="{{ route('user.profile.edit') }}" class="btn btn-primary">Edit Profil</a>
</div>
@endsection
