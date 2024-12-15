<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyRencanaPelaksanaanMbkmColumnInMbkmPendaftaransTable extends Migration
{
    public function up(): void
    {
        Schema::table('mbkm_pendaftarans', function (Blueprint $table) {
            // Hapus kolom pelaksanaan
            $table->dropColumn('rencana_pelaksanaan_mbkm');

            // Tambahkan kolom baru untuk tanggal awal dan akhir
            $table->date('tanggal_awal_mbkm')->after('email')->nullable();
            $table->date('tanggal_akhir_mbkm')->after('tanggal_awal_mbkm')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('mbkm_pendaftarans', function (Blueprint $table) {
            // Hapus kolom tanggal awal dan akhir
            $table->dropColumn('tanggal_awal_mbkm');
            $table->dropColumn('tanggal_akhir_mbkm');

            // Tambahkan kembali kolom pelaksanaan (text)
            $table->text('rencana_pelaksanaan_mbkm')->after('email')->nullable();
        });
    }
}
