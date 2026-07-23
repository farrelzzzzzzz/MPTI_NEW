<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {

            $table->id();

            $table->string('kode_pesawat');

            $table->string('nama_penumpang');

            $table->string('telepon');

            $table->date('tanggal');

            $table->string('flight_pukul');

            $table->string('lokasi_jemput');

            $table->string('lokasi_tujuan');

            $table->string('jam_landing');

            $table->string('jam_jemput');

            $table->integer('jumlah_penumpang');

            $table->string('pembayaran');

            $table->enum('status', [
                'draft',
                'pending',
                'confirmed',
                'completed',
                'cancel'
            ])->default('draft');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
