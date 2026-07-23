<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Order;

try {
    $o = Order::create([
        'kode_pesawat' => 'TST-TEST',
        'nama_penumpang' => 'Tester',
        'telepon' => '08123456789',
        'tanggal' => '2026-07-30',
        'flight_pukul' => '12:00',
        'lokasi_jemput' => 'Yogyakarta International Airport',
        'lokasi_tujuan' => 'Malioboro, Yogyakarta',
        'jam_landing' => '11:00',
        'jam_jemput' => '11:30',
        'jumlah_penumpang' => 2,
        'jarak' => 5.50,
        'harga' => 41250,
        'pembayaran' => 'cash',
        'status' => 'draft'
    ]);

    echo "CREATED:" . $o->id . PHP_EOL;

    $controller = new App\Http\Controllers\OrderController();

    // call confirm
    $view = $controller->confirm($o->id);
    echo "CONFIRM_OK" . PHP_EOL;

    // call sendWa
    $res = $controller->sendWa($o->id);
    if ($res instanceof Illuminate\Http\RedirectResponse) {
        echo "SENDWA_URL:" . $res->getTargetUrl() . PHP_EOL;
    } else {
        echo "SENDWA_NO_URL" . PHP_EOL;
    }

    $saved = Order::find($o->id)->toArray();
    print_r($saved);

} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . PHP_EOL;
    echo $e->getTraceAsString();
}
