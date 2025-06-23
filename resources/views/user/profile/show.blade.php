@extends('layouts.masteruser')

@section('title', 'Profil Saya')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">👤 Profil Saya</h4>
                </div>

                <div class="card-body">
                    <p><strong>Nama:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>

                    <a href="{{ route('user.profile.edit') }}" class="btn btn-outline-primary">
                        ✏️ Edit Profil
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
