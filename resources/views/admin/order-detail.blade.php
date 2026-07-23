@extends('layouts.app')

@section('content')
<div class="admin-page admin-layout">
    @include('admin.partials.sidebar')
    <div class="admin-main">
        <section class="admin-hero">
            <div class="admin-hero-inner">
                <h1>Detail Pesanan</h1>
                <p>Informasi lengkap dan update status pesanan.</p>
            </div>
        </section>

    @if(session('success'))
        <div class="admin-alert success">
            {{ session('success') }}
        </div>
    @endif

    <section class="admin-card admin-order-detail">
        <div class="order-row">
            <div>
                <h2>Kode Pesawat</h2>
                <p>{{ $order->kode_pesawat }}</p>
            </div>
            <div>
                <h2>Nama Penumpang</h2>
                <p>{{ $order->nama_penumpang }}</p>
            </div>
        </div>

        <div class="order-row">
            <div>
                <h2>Telepon</h2>
                <p>{{ $order->telepon }}</p>
            </div>
            <div>
                <h2>Tanggal</h2>
                <p>{{ $order->tanggal }}</p>
            </div>
        </div>

        <div class="order-row">
            <div>
                <h2>Lokasi Jemput</h2>
                <p>{{ $order->lokasi_jemput }}</p>
            </div>
            <div>
                <h2>Lokasi Tujuan</h2>
                <p>{{ $order->lokasi_tujuan }}</p>
            </div>
        </div>

        <div class="order-row">
            <div>
                <h2>Flight Pukul</h2>
                <p>{{ $order->flight_pukul }}</p>
            </div>
            <div>
                <h2>Jam Landing</h2>
                <p>{{ $order->jam_landing }}</p>
            </div>
        </div>

        <div class="order-row">
            <div>
                <h2>Jam Jemput</h2>
                <p>{{ $order->jam_jemput }}</p>
            </div>
            <div>
                <h2>Jumlah Penumpang</h2>
                <p>{{ $order->jumlah_penumpang }}</p>
            </div>
        </div>

        <div class="order-row">
            <div>
                <h2>Metode Pembayaran</h2>
                <p>{{ strtoupper($order->pembayaran) }}</p>
            </div>
            <div>
                <h2>Status</h2>
                <p>{{ ucfirst($order->status) }}</p>
            </div>
        </div>

        <div class="order-row">
            <div>
                <h2>Jarak</h2>
                <p>{{ number_format($order->jarak ?? 0, 2, ',', '.') }} km</p>
            </div>
            <div>
                <h2>Harga</h2>
                <p>Rp {{ number_format($order->harga ?? 0, 0, ',', '.') }}</p>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.orders.status', $order) }}" class="order-status-form">
            @csrf
            @method('PATCH')
            <label for="status">Perbarui Status Pesanan</label>
            <select name="status" id="status">
                @foreach(['draft','pending','confirmed','completed','cancel'] as $status)
                    <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
            <button type="submit" class="auth-btn">Simpan Status</button>
        </form>
    </section>

        <a href="{{ route('admin.orders') }}" class="admin-link-card">Kembali ke Daftar Pesanan</a>
    </div>
</div>
@endsection
