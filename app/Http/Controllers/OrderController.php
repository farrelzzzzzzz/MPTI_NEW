<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\DistanceService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        $order = null;

        if ($request->filled('order_id')) {
            $order = Order::find($request->input('order_id'));
        }

        return view('pages.order', compact('order'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'kode_pesawat'      => 'required',
            'nama_penumpang'    => 'required',
            'telepon'           => 'required',
            'tanggal'           => 'required',
            'flight_pukul'      => 'required',
            'lokasi_jemput'     => 'required',
            'lokasi_tujuan'     => 'required',
            'jam_landing'       => 'required',
            'jam_jemput'        => 'required',
            'jumlah_penumpang'  => 'required|integer|min:1|max:10',
            'pembayaran'        => 'required',
            'jarak'             => 'nullable|numeric|min:0',
            'harga'             => 'nullable|numeric|min:0',
            'lokasi_jemput_lat' => 'nullable|numeric',
            'lokasi_jemput_lon' => 'nullable|numeric',
            'lokasi_tujuan_lat' => 'nullable|numeric',
            'lokasi_tujuan_lon' => 'nullable|numeric',
        ]);

        $origin = $request->lokasi_jemput;
        $destination = $request->lokasi_tujuan;

        if ($request->filled('lokasi_jemput_lat') && $request->filled('lokasi_jemput_lon')) {
            $origin = $request->lokasi_jemput_lat . ',' . $request->lokasi_jemput_lon;
        }

        if ($request->filled('lokasi_tujuan_lat') && $request->filled('lokasi_tujuan_lon')) {
            $destination = $request->lokasi_tujuan_lat . ',' . $request->lokasi_tujuan_lon;
        }
        $order = Order::create([
            'kode_pesawat'      => $request->kode_pesawat,
            'nama_penumpang'    => $request->nama_penumpang,
            'telepon'           => $request->telepon,
            'tanggal'           => $request->tanggal,
            'flight_pukul'      => $request->flight_pukul,
            'lokasi_jemput'     => $request->lokasi_jemput,
            'lokasi_tujuan'     => $request->lokasi_tujuan,
            'lokasi_jemput_lat' => $request->lokasi_jemput_lat,
            'lokasi_jemput_lon' => $request->lokasi_jemput_lon,
            'lokasi_tujuan_lat' => $request->lokasi_tujuan_lat,
            'lokasi_tujuan_lon' => $request->lokasi_tujuan_lon,
            'jam_landing'       => $request->jam_landing,
            'jam_jemput'        => $request->jam_jemput,
            'jumlah_penumpang'  => $request->jumlah_penumpang,
            'jarak'             => $request->jarak ?? null,
            'harga'             => $request->harga ?? 0,
            'pembayaran'        => $request->pembayaran,
            'status'            => 'draft',
        ]);
        // Hitung ulang jika jarak atau harga belum tersedia
        if (empty($order->jarak) || empty($order->harga)) {

            $distanceService = app(DistanceService::class);

            $calc = $distanceService->calculate(
                $origin,
                $destination
            );

            if (!is_null($calc['distance_km'])) {

                $order->jarak = $calc['distance_km'];
                $order->harga = $calc['price'];
            } else {

                // Fallback jika perhitungan gagal
                $order->jarak = 0;
                $order->harga = 100000;
            }

            $order->save();
        }
        return redirect()->route(
            'order.confirm',
            $order->id
        );
    }
    public function confirm($id)
    {
        $order = Order::findOrFail($id);

        return view(
            'pages.order-confirm',
            compact('order')
        );
    }
    public function cancel($id)
    {
        $order = Order::findOrFail($id);

        $order->status = 'cancel';
        $order->save();

        return redirect()
            ->route('order', [
                'order_id' => $order->id
            ])
            ->with('info', 'Pesanan dibatalkan. Data masih tersimpan dan dapat diedit kembali.');
    }
    public function sendWa($id)
    {
        $order = Order::findOrFail($id);

        // Update status menjadi pending
        $order->status = 'pending';
        $order->save();

        Carbon::setLocale('id');

        $tanggal = Carbon::parse($order->tanggal)
            ->translatedFormat('l, d F Y');

        $nomorAdmin = "62882007380782";

        $pesan  = "Terima kasih telah menghubungi *RY TOUR & TRANSPORT*.\n";
        $pesan .= "Silakan beri tahu apa yang dapat kami bantu.\n\n";

        $pesan .= "Kami menyediakan jasa:\n";
        $pesan .= "• Antar Jemput Bandara Jogja\n";
        $pesan .= "• Carter Drop Dalam & Luar Kota\n";
        $pesan .= "• Paket Wisata Jogja\n\n";

        $pesan .= "━━━━━━━━━━━━━━━━━━━━━━\n";
        $pesan .= "        *FORMAT ORDER*\n";
        $pesan .= "━━━━━━━━━━━━━━━━━━━━━━\n\n";
        $pesan .= "✈️ *Kode Pesawat*\n";
        $pesan .= "{$order->kode_pesawat}\n\n";

        $pesan .= "👤 *Nama Penumpang*\n";
        $pesan .= "{$order->nama_penumpang}\n\n";

        $pesan .= "👥 *Jumlah Penumpang*\n";
        $pesan .= "{$order->jumlah_penumpang} Orang\n\n";

        $pesan .= "📞 *Nomor WA*\n";
        $pesan .= "{$order->telepon}\n\n";

        $pesan .= "📅 *Hari & Tanggal*\n";
        $pesan .= "{$tanggal}\n\n";

        $pesan .= "📍 *Lokasi Jemput*\n";
        $pesan .= "{$order->lokasi_jemput}\n\n";

        $pesan .= "📍 *Lokasi Tujuan*\n";
        $pesan .= "{$order->lokasi_tujuan}\n\n";

        $pesan .= "🛫 *Flight Pukul*\n";
        $pesan .= "{$order->flight_pukul}\n\n";

        $pesan .= "🛬 *Jam Landing*\n";
        $pesan .= "{$order->jam_landing}\n\n";

        $pesan .= "🚐 *Jam Jemput*\n";
        $pesan .= "{$order->jam_jemput}\n\n";

        $pesan .= "📏 *Jarak*\n";
        $pesan .= number_format($order->jarak ?? 0, 2, ',', '.') . " km\n\n";

        $pesan .= "💰 *Tarif*\n";
        $pesan .= "Rp " . number_format($order->harga ?? 0, 0, ',', '.') . "\n\n";

        $pesan .= "💳 *Metode Pembayaran*\n";
        $pesan .= strtoupper($order->pembayaran) . "\n\n";

        $pesan .= "⚠️ Mohon informasikan kepada kami apabila terjadi *RESCHEDULE* atau *DELAY*.\n\n";

        $pesan .= "Terima kasih 🙏";
        return redirect()->away(
            "https://wa.me/" . $nomorAdmin . "?text=" . urlencode($pesan)
        );
    }
}
