<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToKelayakanMbkmTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('kelayakan_mbkm', function (Blueprint $table) {
            // Menambahkan kolom baru berdasarkan input di Blade
            $table->string('nilai_keasramaan')->after('sks_semester6')->default('AB'); // Nilai Keasramaan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kelayakan_mbkm', function (Blueprint $table) {
            // Menghapus kolom baru yang ditambahkan
            $table->dropColumn('nilai_keasramaan');
        });
    }
}

