<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Http\Request;
use App\Http\Controllers\OrderController;

try {
    $data = [
        'kode_pesawat' => 'JT-123',
        'nama_penumpang' => 'gogon',
        'telepon' => '08213213124',
        'tanggal' => '2026-07-22',
        'flight_pukul' => '13:00',
        'lokasi_jemput' => 'bandara',
        'lokasi_tujuan' => 'jogja',
        'jam_landing' => '12:00',
        'jam_jemput' => '13:00',
        'jumlah_penumpang' => 2,
        'pembayaran' => 'bca',
        // 'jarak' and 'harga' intentionally omitted to simulate client not providing
    ];

    $request = Request::create('/order/store', 'POST', $data);

    $controller = new OrderController();
    $response = $controller->store($request);

    echo "STORE_RESPONSE_TYPE: " . get_class($response) . PHP_EOL;

    // find last order
    $order = App\Models\Order::latest()->first();
    print_r($order->toArray());

} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . PHP_EOL;
    echo $e->getTraceAsString();
}
