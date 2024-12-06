<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCatatanToKelayakanKpsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('kelayakan_kps', function (Blueprint $table) {
            $table->text('catatan_doswal')->nullable()->after('status_kelayakan');
            $table->text('catatan_kaprodi')->nullable()->after('catatan_doswal');
            $table->text('catatan_koordinator')->nullable()->after('catatan_kaprodi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('kelayakan_kps', function (Blueprint $table) {
            $table->dropColumn(['catatan_doswal', 'catatan_kaprodi', 'catatan_koordinator']);
        });
    }
}
