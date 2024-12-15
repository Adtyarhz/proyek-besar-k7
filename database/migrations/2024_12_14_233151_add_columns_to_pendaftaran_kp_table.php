<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToPendaftaranKpTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pendaftaran_kp', function (Blueprint $table) {
            // Menambahkan kolom sesuai inputan pada blade
            $table->string('email_perusahaan')->after('email')->nullable();
            $table->string('role_kp')->after('lokasi')->nullable();
            // Kolom tanggal_awal dan tanggal_akhir sudah ada di migrasi sebelumnya, tidak perlu ditambahkan lagi
            $table->string('surat_pengantar')->after('bukti_penerimaan')->nullable(); // Path untuk file surat pengantar
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftaran_kp', function (Blueprint $table) {
            // Hapus kolom-kolom yang baru ditambahkan
            $table->dropColumn('email_perusahaan');
            $table->dropColumn('role');
            $table->dropColumn('surat_pengantar');
            // Kolom tanggal_awal dan tanggal_akhir tidak dihapus karena bukan bagian dari migrasi ini
        });
    }
}

