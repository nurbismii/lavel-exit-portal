@extends('layouts.app')

@section('content')
<div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center bg-light">
    <div class="row w-100 justify-content-center">
        <div class="col-11 col-sm-8 col-md-6 col-lg-4">
            <div class="card shadow border-0 rounded-4">
                <div class="card-body p-4">

                    <div class="text-center mb-4">
                        <h4 class="fw-bold mb-1">Register</h4>
                        <small class="text-muted">Buat akun baru</small>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        {{-- Nama Karyawan --}}
                        <div class="mb-3">
                            <label for="nama_karyawan" class="form-label">Nama Lengkap</label>
                            <input id="nama_karyawan"
                                type="text"
                                class="form-control @error('nama_karyawan') is-invalid @enderror"
                                name="nama_karyawan"
                                value="{{ old('nama_karyawan') }}"
                                required
                                autofocus>

                            @error('nama_karyawan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        {{-- NIK --}}
                        <div class="mb-3">
                            <label for="nik" class="form-label">NIK</label>
                            <input id="nik"
                                type="text"
                                class="form-control @error('nik') is-invalid @enderror"
                                name="nik"
                                value="{{ old('nik') }}"
                                required>

                            @error('nik')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input id="email"
                                type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                name="email"
                                value="{{ old('email') }}"
                                required>

                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        {{-- TANGGAL LAHIR --}}
                        <div class="mb-3">
                            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                            <input id="tgl_lahir"
                                type="date"
                                class="form-control @error('tgl_lahir') is-invalid @enderror"
                                name="tgl_lahir"
                                value="{{ old('tgl_lahir') }}"
                                required>

                            @error('tgl_lahir')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input id="password"
                                type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                name="password"
                                required>

                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input id="password_confirmation"
                                type="password"
                                class="form-control"
                                name="password_confirmation"
                                required>
                        </div>

                        {{-- Submit --}}
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary rounded-3">
                                Register
                            </button>
                        </div>

                    </form>

                </div>
            </div>

            <div class="text-center mt-3">
                <small class="text-muted">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-decoration-none">Login</a>
                </small>
            </div>
        </div>
    </div>
</div>
@endsection