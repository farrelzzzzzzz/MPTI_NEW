@extends('layouts.auth')

@section('title', 'Admin Login - RY Travel')
@section('auth-title', 'Login Admin')
@section('auth-subtitle', 'Masuk menggunakan akun administrator Anda')

@section('auth-content')
    @if (session('lockout_error'))
        <div class="auth-lockout-alert">
            <i class="fas fa-clock"></i>
            <div class="lockout-content">
                <strong>Akun Terkunci</strong>
                <p>{{ session('lockout_error') }}</p>
            </div>
        </div>
    @endif

    <form class="auth-form" method="POST" action="{{ route('admin.login') }}">
        @csrf

        <div class="form-group">
            <label for="email">Email Admin</label>
            <div class="input-wrapper">
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Masukkan email admin">
                <i class="fas fa-envelope"></i>
            </div>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <div class="input-wrapper">
                <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Masukkan password Anda">
                <i class="fas fa-lock"></i>
            </div>
        </div>

        <div class="auth-options">
            <label class="remember-me">
                <input type="checkbox" name="remember">
                <span>Ingat saya</span>
            </label>
        </div>

        <button type="submit" class="auth-btn">Masuk sebagai Admin</button>
    </form>

    <div class="auth-switch">
        <p>Login sebagai pengguna biasa? <a href="{{ route('login') }}">Masuk di sini</a></p>
    </div>
@endsection
