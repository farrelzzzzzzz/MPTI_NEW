@extends('layouts.auth')

@section('title', 'Daftar - RY Travel')
@section('auth-title', 'Buat Akun Baru')
@section('auth-subtitle', 'Daftar untuk memulai pemesanan')

@section('auth-content')
    <form class="auth-form" method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label for="name">Nama Lengkap</label>
            <div class="input-wrapper">
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Masukkan nama lengkap">
                <i class="fas fa-user"></i>
            </div>

        <div class="form-group">
            <label for="email">Email</label>
            <div class="input-wrapper">
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="Masukkan email Anda">
                <i class="fas fa-envelope"></i>
            </div>

        <div class="form-group">
            <label for="password">Password</label>
            <div class="input-wrapper">
                <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Buat password">
                <i class="fas fa-lock"></i>
            </div>

        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password</label>
            <div class="input-wrapper">
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi password">
                <i class="fas fa-lock"></i>
            </div>

        <button type="submit" class="auth-btn">Daftar</button>
    </form>

    <div class="auth-divider">
        <span>atau</span>
    </div>

    <a href="{{ route('google.login') }}" class="google-btn">
        <svg width="22" height="22" viewBox="0 0 48 48">
            <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"></path>
            <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"></path>
            <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"></path>
            <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"></path>
        </svg>
        Daftar dengan Google
    </a>

    <div class="auth-switch">
        <p>Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></p>
    </div>
@endsection
