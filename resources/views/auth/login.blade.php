@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container">
    <div class="row justify-content-center min-vh-100 align-items-center">
        <div class="col-md-5 col-lg-4">
            <div class="card glass animate__animated animate__fadeInUp" style="border-radius: 24px; border: 1px solid rgba(255, 107, 53, 0.3);">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <div class="mb-3" style="width: 80px; height: 80px; margin: 0 auto; background: linear-gradient(135deg, #FF6B35 0%, #F7C94B 50%, #FF9F1C 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 0 30px rgba(255, 107, 53, 0.5);">
                            <i class="bi bi-sun-fill text-white" style="font-size: 2.5rem;"></i>
                        </div>
                        <h2 class="mt-3 fw-bold" style="background: linear-gradient(135deg, #FF6B35, #F7C94B); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Welcome Back</h2>
                        <p class="text-muted">Sign in to continue</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text" style="background: rgba(255, 107, 53, 0.1); border: 2px solid rgba(255, 255, 255, 0.1); border-right: none; border-radius: 12px 0 0 12px;">
                                    <i class="bi bi-envelope text-warning"></i>
                                </span>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       id="email" name="email" value="{{ old('email') }}" 
                                       placeholder="Enter your email" required autofocus
                                       style="border-left: none; border-radius: 0 12px 12px 0;">
                            </div>
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <div class="input-group">
                                <span class="input-group-text" style="background: rgba(255, 107, 53, 0.1); border: 2px solid rgba(255, 255, 255, 0.1); border-right: none; border-radius: 12px 0 0 12px;">
                                    <i class="bi bi-lock text-warning"></i>
                                </span>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                       id="password" name="password" 
                                       placeholder="Enter your password" required
                                       style="border-left: none; border-radius: 0 12px 12px 0;">
                            </div>
                            @error('password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember" 
                                   style="accent-color: #FF6B35;">
                            <label class="form-check-label text-muted" for="remember">Remember me</label>
                        </div>

                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-primary btn-lg fw-semibold">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
                            </button>
                        </div>
                    </form>

                    <div class="text-center">
                        <p class="mb-0 text-muted">Don't have an account? 
                            <a href="{{ route('register') }}" class="fw-bold text-decoration-none" 
                               style="background: linear-gradient(135deg, #FF6B35, #F7C94B); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                                Create Account
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
