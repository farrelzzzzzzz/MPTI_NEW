@extends('layouts.auth')

@section('title', 'Lupa Password - RY Travel')
@section('auth-title', 'Lupa Password')
@section('auth-subtitle', 'Masukkan email Anda untuk menerima tautan reset password')

@section('auth-content')
    <div class="auth-info-text">
        <i class="fas fa-envelope-open-text"></i>
        <p>Jangan khawatir! Masukkan email Anda dan kami akan mengirimkan tautan untuk mereset password Anda.</p>
    </div>

    <form class="auth-form" method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="form-group">
            <label for="email">Email</label>
            <div class="input-wrapper">
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Masukkan email Anda">
                <i class="fas fa-envelope"></i>
            </div>
        </div>

        <button type="submit" class="auth-btn">
            <i class="fas fa-paper-plane" style="margin-right: 8px;"></i> Kirim Tautan Reset
        </button>
    </form>

    <div class="auth-switch">
        <p><a href="{{ route('login') }}"><i class="fas fa-arrow-left"></i> Kembali ke Login</a></p>
    </div>
@endsection
