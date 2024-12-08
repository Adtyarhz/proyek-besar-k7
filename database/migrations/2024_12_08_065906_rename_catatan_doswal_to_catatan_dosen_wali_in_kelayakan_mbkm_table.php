<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameCatatanDoswalToCatatanDosenWaliInKelayakanMbkmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kelayakan_mbkm', function (Blueprint $table) {
            if (Schema::hasColumn('kelayakan_mbkm', 'catatan_doswal')) {
                $table->renameColumn('catatan_doswal', 'catatan_dosen_wali');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kelayakan_mbkm', function (Blueprint $table) {
            if (Schema::hasColumn('kelayakan_mbkm', 'catatan_dosen_wali')) {
                $table->renameColumn('catatan_dosen_wali', 'catatan_doswal');
            }
        });
    }
}
