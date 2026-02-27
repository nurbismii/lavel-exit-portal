@extends('layouts.app')

@section('content')
<div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center bg-light">
    <div class="row w-100 justify-content-center">
        <div class="col-11 col-sm-8 col-md-6 col-lg-4">
            <div class="card shadow border-0 rounded-4 card-hover">
                <div class="card-accent rounded-top"></div>

                <div class="card-body p-4">

                    <div class="text-center mb-4">
                        <h4 class="fw-bold mb-1">Login</h4>
                        <small class="text-muted">Silakan masuk ke akun Anda</small>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email"
                                type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus>

                            @error('email')
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

                        {{-- Button --}}
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary rounded-3">
                                Login
                            </button>
                        </div>

                    </form>

                </div>
            </div>

            <div class="text-center mt-3">
                <small class="text-muted">
                    © {{ date('Y') }} PT Virtue Dragon Nickel Industry
                </small>
            </div>
        </div>
    </div>
</div>
@endsection