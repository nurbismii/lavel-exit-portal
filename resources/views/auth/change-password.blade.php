@extends('layouts.app')

@section('content')
<div class="container mt-5" style="max-width: 500px;">
    <div class="card shadow-sm">
        <div class="card-header fw-bold" style="background: linear-gradient(90deg, #0d6efd, #198754);">
            Ganti Password
        </div>
        <div class="card-body">

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Password Lama</label>
                    <input type="password" name="current_password"
                        class="form-control @error('current_password') is-invalid @enderror">
                    @error('current_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Password Baru</label>
                    <input type="password" name="password"
                        class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation"
                        class="form-control">
                </div>

                <button type="submit" class="btn btn-success w-100 mb-3">
                    Perbarui Password
                </button>

                <a href="{{ route('home') }}" class="btn btn-primary w-100">
                    Tutup
                </a>

            </form>
        </div>
    </div>
</div>
@endsection