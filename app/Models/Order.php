<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = [

        'kode_pesawat',
        'nama_penumpang',
        'telepon',
        'tanggal',
        'flight_pukul',
        'lokasi_jemput',
        'lokasi_tujuan',
        'lokasi_jemput_lat',
        'lokasi_jemput_lon',
        'lokasi_tujuan_lat',
        'lokasi_tujuan_lon',
        'jam_landing',
        'jam_jemput',
        'jumlah_penumpang',
        'jarak',
        'harga',
        'pembayaran',
        'status'

    ];
}
