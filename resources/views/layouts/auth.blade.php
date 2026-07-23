<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'RY Travel')</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>

<div class="auth-page">
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-logo">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="RY Travel Logo">
                </a>
            </div>

            <h1 class="auth-title">@yield('auth-title')</h1>
            <p class="auth-subtitle">@yield('auth-subtitle')</p>

            @if (session('status'))
                <div class="auth-session-status">
                    {{ session('status') }}
                </div>
            @endif

            @if (session('error'))
                <div class="auth-error-alert">
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="auth-error-alert">
                    <i class="fas fa-exclamation-circle"></i>
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            @yield('auth-content')
        </div>
</div>

</body>
</html>
