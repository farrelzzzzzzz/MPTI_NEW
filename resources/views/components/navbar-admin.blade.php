<nav class="navbar admin-navbar">

    <a href="{{ route('admin.dashboard') }}" class="logo">
        <img src="{{ asset('images/logo.png') }}" alt="RY Travel Logo">
    </a>

    <ul class="nav-links">
        <li><a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-chart-pie"></i> Dashboard
        </a></li>
        <li><a class="nav-link {{ request()->routeIs('admin.orders*') ? 'active' : '' }}" href="{{ route('admin.orders') }}">
            <i class="fas fa-shopping-cart"></i> Pesanan
        </a></li>
        <li><a class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}" href="{{ route('admin.users') }}">
            <i class="fas fa-users"></i> Pengguna
        </a></li>
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
                    <a href="{{ route('home') }}" class="dropdown-item">
                        <i class="fas fa-arrow-left"></i> Kembali ke Website
                    </a>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        @endauth
    </div>

</nav>

