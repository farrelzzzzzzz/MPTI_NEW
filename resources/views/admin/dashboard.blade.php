@extends('layouts.app')

@section('content')
<div class="admin-page admin-layout">
    @include('admin.partials.sidebar')
    <div class="admin-main">
        <section class="admin-hero">
            <div class="admin-hero-inner">
                <h1>Dashboard Admin</h1>
                <p>Ringkasan sistem untuk admin RY Travel.</p>
            </div>
        </section>

    <section class="admin-metrics">
        <div class="metric-card">
            <h2>{{ $totalUsers }}</h2>
            <p>Total Pengguna</p>
        </div>
        <div class="metric-card">
            <h2>{{ $totalOrders }}</h2>
            <p>Total Pesanan</p>
        </div>
        <div class="metric-card">
            <h2>{{ $pendingOrders }}</h2>
            <p>Pesanan Pending</p>
        </div>
        <div class="metric-card">
            <h2>{{ $cancelledOrders }}</h2>
            <p>Pesanan Batal</p>
        </div>
    </section>

    <section class="admin-dashboard-chart">
        <div class="chart-card">
            <div class="chart-card-header">
                <h2>Statistik Pesanan Berdasarkan Status</h2>
            </div>
            <div class="chart-wrapper">
                <canvas id="orderStatusChart"></canvas>
            </div>
        </div>
    </section>

        <section class="admin-links">
            <a href="{{ route('admin.orders') }}" class="admin-link-card">Lihat Semua Pesanan</a>
            <a href="{{ route('admin.users') }}" class="admin-link-card">Kelola Pengguna</a>
        </section>
    </div>
</div>
@endsection

@push('scripts')
<script>
window.chartColors = ['#4f46e5', '#f59e0b', '#10b981', '#3b82f6', '#ef4444'];
window.statusLabels = @json($statusLabels);
window.statusValues = @json($statusValues);
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"
        onerror="console.error('Chart.js gagal dimuat dari CDN')"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('orderStatusChart');
        if (!ctx) {
            console.error('Canvas #orderStatusChart tidak ditemukan!');
            return;
        }

        if (typeof Chart === 'undefined') {
            console.error('Chart.js tidak tersedia, muat ulang halaman.');
            ctx.parentElement.innerHTML = '<p style="color:#999;text-align:center;padding:40px;">Grafik tidak dapat dimuat. Silakan refresh halaman.</p>';
            return;
        }

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: window.statusLabels,
                datasets: [{
                    label: 'Jumlah Pesanan',
                    data: window.statusValues,
                    backgroundColor: window.chartColors,
                    borderColor: '#ffffff',
                    borderWidth: 2,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                },
            },
        });
    });
</script>
@endpush
