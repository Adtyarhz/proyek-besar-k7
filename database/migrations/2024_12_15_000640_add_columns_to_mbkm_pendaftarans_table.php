<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToMbkmPendaftaransTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('mbkm_pendaftarans', function (Blueprint $table) {
            // Menambahkan kolom baru berdasarkan input di Blade
            $table->string('ekivalensi_sks')->after('lokasi_mbkm')->default('AB'); // Nilai Keasramaan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ekivalensi_sks', function (Blueprint $table) {
            // Menghapus kolom baru yang ditambahkan
            $table->dropColumn('lokasi_mbkm');
        });
    }
}

