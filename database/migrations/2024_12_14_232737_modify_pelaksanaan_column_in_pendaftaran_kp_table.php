<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyPelaksanaanColumnInPendaftaranKpTable extends Migration
{
    public function up(): void
    {
        Schema::table('pendaftaran_kp', function (Blueprint $table) {
            // Hapus kolom pelaksanaan
            $table->dropColumn('pelaksanaan');

            // Tambahkan kolom baru untuk tanggal awal dan akhir
            $table->date('tanggal_awal')->after('perusahaan')->nullable();
            $table->date('tanggal_akhir')->after('tanggal_awal')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('pendaftaran_kp', function (Blueprint $table) {
            // Hapus kolom tanggal awal dan akhir
            $table->dropColumn('tanggal_awal');
            $table->dropColumn('tanggal_akhir');

            // Tambahkan kembali kolom pelaksanaan (text)
            $table->text('pelaksanaan')->after('perusahaan')->nullable();
        });
    }
}

