@extends('layouts.auth')

@section('title', 'Reset Password - RY Travel')
@section('auth-title', 'Reset Password')
@section('auth-subtitle', 'Buat password baru untuk akun Anda')

@section('auth-content')
    <form class="auth-form" method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $token ?? $request->route('token') }}">

        <div class="form-group">
            <label for="email">Email</label>
            <div class="input-wrapper">
                <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username" placeholder="Masukkan email Anda">
                <i class="fas fa-envelope"></i>
            </div>
        </div>

        <div class="form-group">
            <label for="password">Password Baru</label>
            <div class="input-wrapper">
                <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Masukkan password baru">
                <i class="fas fa-lock"></i>
            </div>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password</label>
            <div class="input-wrapper">
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi password baru">
                <i class="fas fa-lock"></i>
            </div>
        </div>

        <button type="submit" class="auth-btn">
            <i class="fas fa-sync-alt" style="margin-right: 8px;"></i> Reset Password
        </button>
    </form>

    <div class="auth-switch">
        <p><a href="{{ route('login') }}"><i class="fas fa-arrow-left"></i> Kembali ke Login</a></p>
    </div>
@endsection
