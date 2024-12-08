<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSksKoordinatorToMbkmPendaftaransTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('mbkm_pendaftarans', function (Blueprint $table) {
            $table->integer('sks_koordinator')->nullable()->after('catatan_koordinator');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('mbkm_pendaftarans', function (Blueprint $table) {
            $table->dropColumn('sks_koordinator');
        });
    }
}
