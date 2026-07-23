<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Export Pesanan - RY Travel</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 11px;
            color: #333;
            line-height: 1.4;
        }
        .header {
            text-align: center;
            padding: 20px 0 15px;
            border-bottom: 3px solid #E3000F;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #E3000F;
            font-size: 22px;
            margin-bottom: 5px;
        }
        .header p {
            color: #666;
            font-size: 12px;
        }
        .filter-info {
            margin-bottom: 15px;
            padding: 8px 12px;
            background: #f8f8f8;
            border-left: 4px solid #E3000F;
            font-size: 11px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table thead th {
            background: #E3000F;
            color: #fff;
            padding: 8px 6px;
            text-align: left;
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
        }
        table tbody td {
            padding: 6px;
            border-bottom: 1px solid #eee;
            font-size: 10px;
        }
        table tbody tr:nth-child(even) {
            background: #fafafa;
        }
        table tbody tr:hover {
            background: #fff5f5;
        }
        .status-badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 9px;
            font-weight: 600;
        }
        .status-draft { background: #e5e7eb; color: #374151; }
        .status-pending { background: #fef3c7; color: #92400e; }
        .status-confirmed { background: #d1fae5; color: #065f46; }
        .status-completed { background: #dbeafe; color: #1e40af; }
        .status-cancel { background: #fee2e2; color: #991b1b; }
        .footer {
            text-align: center;
            padding-top: 15px;
            margin-top: 20px;
            border-top: 1px solid #ddd;
            font-size: 10px;
            color: #999;
        }
        .page-number {
            text-align: right;
            font-size: 9px;
            color: #bbb;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>RY Travel - Laporan Pesanan</h1>
        <p>Periode: {{ now()->format('d F Y H:i') }}</p>
    </div>

    @if($status)
    <div class="filter-info">
        <strong>Filter Status:</strong> {{ ucfirst($status) }}
    </div>
    @endif
    @if($search)
    <div class="filter-info">
        <strong>Pencarian:</strong> {{ $search }}
    </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Pesawat</th>
                <th>Nama</th>
                <th>Telepon</th>
                <th>Tanggal</th>
                <th>Lokasi Jemput</th>
                <th>Lokasi Tujuan</th>
                <th>Jumlah</th>
                <th>Bayar</th>
                <th>Harga</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $i => $order)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $order->kode_pesawat }}</td>
                <td>{{ $order->nama_penumpang }}</td>
                <td>{{ $order->telepon }}</td>
                <td>{{ $order->tanggal }}</td>
                <td>{{ $order->lokasi_jemput }}</td>
                <td>{{ $order->lokasi_tujuan }}</td>
                <td style="text-align:center">{{ $order->jumlah_penumpang }}</td>
                <td>{{ strtoupper($order->pembayaran) }}</td>
                <td style="text-align:right">Rp {{ number_format($order->harga ?? 0, 0, ',', '.') }}</td>
                <td>
                    <span class="status-badge status-{{ $order->status }}">{{ ucfirst($order->status) }}</span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="11" style="text-align:center; padding:30px; color:#999;">
                    Tidak ada pesanan ditemukan.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if(count($orders) > 0)
    <div style="margin-top:15px; padding:10px; background:#f8f8f8; border-radius:5px;">
        <strong>Ringkasan:</strong>
        Total Pesanan: {{ count($orders) }}
    </div>
    @endif

    <div class="footer">
        <p>RY Travel &mdash; Antar Jemput Bandara Jogja</p>
        <p>Dicetak pada: {{ now()->format('d F Y H:i:s') }}</p>
    </div>
    <div class="page-number">
        Halaman {PAGE_NUM} dari {PAGE_COUNT}
    </div>
</body>
</html>

