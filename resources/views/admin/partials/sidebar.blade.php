<aside class="admin-sidebar">
    <div class="admin-sidebar-card">
        <h3>Panel Admin</h3>
        <nav class="admin-sidebar-nav">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('admin.orders') }}" class="{{ request()->routeIs('admin.orders*') ? 'active' : '' }}">Pesanan</a>
            <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users*') ? 'active' : '' }}">Pengguna</a>
        </nav>
    </div>
</aside>
