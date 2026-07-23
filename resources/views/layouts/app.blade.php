<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>RY Travel</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/chatbot.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
</head>

<body>

    <div id="loader">
        <img src="{{ asset('images/logo.png') }}">
    </div>

    @auth
        @if(Auth::user()->isAdmin() && request()->is('admin/*'))
            @include('components.navbar-admin')
        @else
            @include('components.navbar')
        @endif
    @else
        @include('components.navbar')
    @endauth

    @yield('content')

    @include('components.footer')

    <script src="{{ asset('js/script.js') }}"></script>

    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

    <script>
        AOS.init({
            duration: 1000,
            once: true
        });
    </script>

    @stack('scripts')

@guest
    <script src="{{ asset('js/chatbot.js') }}"></script>
    @include('chatbot.widget')
@else
    @if(!Auth::user()->isAdmin())
        <script src="{{ asset('js/chatbot.js') }}"></script>
        @include('chatbot.widget')
    @endif
@endguest

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    
</body>

</html>