@extends('layouts.app')

@section('content')
<div class="admin-page admin-layout">
    @include('admin.partials.sidebar')
    <div class="admin-main">
        <section class="admin-hero">
            <div class="admin-hero-inner">
                <h1>Pengguna Admin</h1>
                <p>Daftar semua pengguna dan peran mereka.</p>
            </div>
        </section>

    @if(session('success'))
        <div class="admin-alert success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="admin-alert error">
            {{ $errors->first() }}
        </div>
    @endif

    <section class="admin-table-filters">
        <form method="GET" action="{{ route('admin.users') }}" class="admin-filter-form">
            <input type="search" name="search" placeholder="Cari pengguna..." value="{{ $search ?? '' }}">
            <button type="submit" class="auth-btn">Cari</button>
        </form>
    </section>

    <section class="admin-table">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst($user->role) }}</td>
                        <td>
                            <form method="POST" action="{{ route('admin.users.role', $user) }}">
                                @csrf
                                @method('PATCH')
                                <select name="role" onchange="this.form.submit()" class="role-select" {{ $user->id === auth()->id() ? 'disabled' : '' }}>
                                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>

        <div class="admin-pagination">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
