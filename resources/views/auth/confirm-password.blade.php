@extends('layouts.auth')

@section('title', 'Konfirmasi Password - RY Travel')
@section('auth-title', 'Konfirmasi Password')
@section('auth-subtitle', 'Masukkan password Anda untuk melanjutkan')

@section('auth-content')
    <div class="auth-info-text">
        <i class="fas fa-shield-alt"></i>
        <p>Ini adalah area aman. Harap konfirmasi password Anda sebelum melanjutkan.</p>
    </div>

    <form class="auth-form" method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="form-group">
            <label for="password">Password</label>
            <div class="input-wrapper">
                <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Masukkan password Anda">
                <i class="fas fa-lock"></i>
            </div>
        </div>

        <button type="submit" class="auth-btn">
            <i class="fas fa-check-circle" style="margin-right: 8px;"></i> Konfirmasi
        </button>
    </form>

    <div class="auth-switch">
        <p><a href="{{ route('home') }}"><i class="fas fa-arrow-left"></i> Kembali ke Beranda</a></p>
    </div>
@endsection
