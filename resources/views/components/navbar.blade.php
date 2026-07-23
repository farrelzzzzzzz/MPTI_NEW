<nav class="navbar">

    <a href="{{ route('about') }}" class="logo">
        <img src="{{ asset('images/logo.png') }}" alt="RY Travel Logo">
    </a>

    <ul class="nav-links">
        <li><a class="nav-link" href="{{ route('home') }}">Home</a></li>
        <li><a class="nav-link" href="{{ route('about') }}">Tentang</a></li>
        <li><a class="nav-link" href="{{ route('testimoni') }}">Testimoni</a></li>
        <li><a class="nav-link" href="{{ route('kontak') }}">Kontak</a></li>
    </ul>

    <div class="nav-auth">
        @auth
            <div class="user-dropdown">
                <button class="user-dropdown-btn">
                    <i class="fas fa-user-circle"></i>
                    <span>{{ Auth::user()->name }}</span>
                    <i class="fas fa-chevron-down" style="font-size: 12px;"></i>
                </button>
                <div class="user-dropdown-menu">
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="dropdown-item">
                            <i class="fas fa-shield-alt"></i> Panel Admin
                        </a>
                        <div class="dropdown-divider"></div>
                    @endif
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        @else
            <a href="{{ route('login') }}" class="login-btn">
                <i class="fas fa-sign-in-alt"></i>
                <span>Login</span>
            </a>
        @endauth
    </div>

</nav>
