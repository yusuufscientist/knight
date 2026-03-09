@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="container">
    <div class="row justify-content-center min-vh-100 align-items-center py-5">
        <div class="col-md-6 col-lg-5">
            <div class="card glass animate__animated animate__fadeInUp" style="border-radius: 24px; border: 1px solid rgba(255, 107, 53, 0.3);">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <div class="mb-3" style="width: 80px; height: 80px; margin: 0 auto; background: linear-gradient(135deg, #FF6B35 0%, #F7C94B 50%, #FF9F1C 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 0 30px rgba(255, 107, 53, 0.5);">
                            <i class="bi bi-sun-fill text-white" style="font-size: 2.5rem;"></i>
                        </div>
                        <h2 class="mt-3 fw-bold" style="background: linear-gradient(135deg, #FF6B35, #F7C94B); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Create Account</h2>
                        <p class="text-muted">Join SolarSmart today</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Full Name</label>
                            <div class="input-group">
                                <span class="input-group-text" style="background: rgba(255, 107, 53, 0.1); border: 2px solid rgba(255, 255, 255, 0.1); border-right: none; border-radius: 12px 0 0 12px;">
                                    <i class="bi bi-person text-warning"></i>
                                </span>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       id="name" name="name" value="{{ old('name') }}" 
                                       placeholder="Enter your full name" required autofocus
                                       style="border-left: none; border-radius: 0 12px 12px 0;">
                            </div>
                            @error('name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text" style="background: rgba(255, 107, 53, 0.1); border: 2px solid rgba(255, 255, 255, 0.1); border-right: none; border-radius: 12px 0 0 12px;">
                                    <i class="bi bi-envelope text-warning"></i>
                                </span>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       id="email" name="email" value="{{ old('email') }}" 
                                       placeholder="Enter your email" required
                                       style="border-left: none; border-radius: 0 12px 12px 0;">
                            </div>
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label fw-semibold">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text" style="background: rgba(255, 107, 53, 0.1); border: 2px solid rgba(255, 255, 255, 0.1); border-right: none; border-radius: 12px 0 0 12px;">
                                        <i class="bi bi-lock text-warning"></i>
                                    </span>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                           id="password" name="password" 
                                           placeholder="Password" required
                                           style="border-left: none; border-radius: 0 12px 12px 0;">
                                </div>
                                @error('password')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label fw-semibold">Confirm</label>
                                <div class="input-group">
                                    <span class="input-group-text" style="background: rgba(255, 107, 53, 0.1); border: 2px solid rgba(255, 255, 255, 0.1); border-right: none; border-radius: 12px 0 0 12px;">
                                        <i class="bi bi-lock-fill text-warning"></i>
                                    </span>
                                    <input type="password" class="form-control"
                                           id="password_confirmation" name="password_confirmation" 
                                           placeholder="Confirm" required
                                           style="border-left: none; border-radius: 0 12px 12px 0;">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label fw-semibold">Phone Number <span class="text-muted">(Optional)</span></label>
                            <div class="input-group">
                                <span class="input-group-text" style="background: rgba(255, 107, 53, 0.1); border: 2px solid rgba(255, 255, 255, 0.1); border-right: none; border-radius: 12px 0 0 12px;">
                                    <i class="bi bi-phone text-warning"></i>
                                </span>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                       id="phone" name="phone" value="{{ old('phone') }}"
                                       placeholder="Enter phone number"
                                       style="border-left: none; border-radius: 0 12px 12px 0;">
                            </div>
                            @error('phone')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="address" class="form-label fw-semibold">Address <span class="text-muted">(Optional)</span></label>
                            <div class="input-group">
                                <span class="input-group-text" style="background: rgba(255, 107, 53, 0.1); border: 2px solid rgba(255, 255, 255, 0.1); border-right: none; border-radius: 12px 0 0 12px; align-items: flex-start; padding-top: 12px;">
                                    <i class="bi bi-geo-alt text-warning"></i>
                                </span>
                                <textarea class="form-control @error('address') is-invalid @enderror"
                                          id="address" name="address" rows="2"
                                          placeholder="Enter your address"
                                          style="border-left: none; border-radius: 0 12px 12px 0;">{{ old('address') }}</textarea>
                            </div>
                            @error('address')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-primary btn-lg fw-semibold">
                                <i class="bi bi-person-plus me-2"></i>Create Account
                            </button>
                        </div>
                    </form>

                    <div class="text-center">
                        <p class="mb-0 text-muted">Already have an account? 
                            <a href="{{ route('login') }}" class="fw-bold text-decoration-none" 
                               style="background: linear-gradient(135deg, #FF6B35, #F7C94B); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                                Sign In
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
