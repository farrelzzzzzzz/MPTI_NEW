@extends('layouts.app')

@section('content')
<div class="admin-page admin-layout">
    @include('admin.partials.sidebar')
    <div class="admin-main">
        <section class="admin-hero">
            <div class="admin-hero-inner">
                <h1>Pesanan Admin</h1>
                <p>Daftar semua pesanan pengguna yang masuk.</p>
            </div>
        </section>

    @if(session('success'))
        <div class="admin-alert success">{{ session('success') }}</div>
    @endif

    <section class="admin-table-actions">
        <form method="GET" action="{{ route('admin.orders') }}" class="admin-filter-form">
            <input type="search" name="search" placeholder="Cari pesanan..." value="{{ $search ?? '' }}">
            <select name="status">
                <option value="">Semua Status</option>
                @foreach(['draft','pending','confirmed','completed','cancel'] as $item)
                    <option value="{{ $item }}" {{ ($status ?? '') === $item ? 'selected' : '' }}>{{ ucfirst($item) }}</option>
                @endforeach
            </select>
            <button type="submit" class="auth-btn">Filter</button>
            <a href="{{ route('admin.orders.export') }}{{ request()->getQueryString() ? '?' . request()->getQueryString() : '' }}" class="auth-btn admin-export-btn">Export PDF</a>
        </form>
    </section>

    <section class="admin-table">
        <form method="POST" action="{{ route('admin.orders.batch') }}" id="batchUpdateForm">
            @csrf
            @method('PATCH')
            <div class="batch-actions-row">
                <label class="batch-select-all-label">
                    <input type="checkbox" id="selectAllOrdersToggle">
                    Pilih Semua
                </label>
                <select name="status" required>
                    <option value="">Ubah status menjadi...</option>
                    @foreach(['draft','pending','confirmed','completed','cancel'] as $item)
                        <option value="{{ $item }}">{{ ucfirst($item) }}</option>
                    @endforeach
                </select>
                <button type="submit" class="auth-btn">Perbarui Status Terpilih</button>
            </div>

            <table>
                <thead>
                    <tr>
                        <th><input type="checkbox" id="selectAllOrdersHeader"></th>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Telepon</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Metode Bayar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td><input type="checkbox" name="order_ids[]" value="{{ $order->id }}" class="order-checkbox"></td>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->nama_penumpang }}</td>
                            <td>{{ $order->telepon }}</td>
                            <td>{{ $order->tanggal }}</td>
                            <td>{{ ucfirst($order->status) }}</td>
                            <td>{{ strtoupper($order->pembayaran) }}</td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order) }}" class="admin-action-link">Lihat</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">Tidak ada pesanan ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </form>
    </section>

        <div class="admin-pagination">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectAllToggle = document.getElementById('selectAllOrdersToggle');
        const selectAllHeader = document.getElementById('selectAllOrdersHeader');
        const checkboxes = document.querySelectorAll('.order-checkbox');

        function syncSelectAll() {
            const allChecked = Array.from(checkboxes).every(function (item) {
                return item.checked;
            });
            if (selectAllToggle) selectAllToggle.checked = allChecked;
            if (selectAllHeader) selectAllHeader.checked = allChecked;
        }

        if (selectAllToggle) {
            selectAllToggle.addEventListener('change', function () {
                checkboxes.forEach(function (item) {
                    item.checked = selectAllToggle.checked;
                });
                if (selectAllHeader) selectAllHeader.checked = selectAllToggle.checked;
            });
        }

        if (selectAllHeader) {
            selectAllHeader.addEventListener('change', function () {
                checkboxes.forEach(function (item) {
                    item.checked = selectAllHeader.checked;
                });
                if (selectAllToggle) selectAllToggle.checked = selectAllHeader.checked;
            });
        }

        checkboxes.forEach(function (item) {
            item.addEventListener('change', syncSelectAll);
        });
    });
</script>
@endpush

