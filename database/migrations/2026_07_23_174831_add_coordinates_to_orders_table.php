<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            $table->decimal('lokasi_jemput_lat',10,7)->nullable();
            $table->decimal('lokasi_jemput_lon',10,7)->nullable();

            $table->decimal('lokasi_tujuan_lat',10,7)->nullable();
            $table->decimal('lokasi_tujuan_lon',10,7)->nullable();

        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            $table->dropColumn([
                'lokasi_jemput_lat',
                'lokasi_jemput_lon',
                'lokasi_tujuan_lat',
                'lokasi_tujuan_lon'
            ]);

        });
    }
};