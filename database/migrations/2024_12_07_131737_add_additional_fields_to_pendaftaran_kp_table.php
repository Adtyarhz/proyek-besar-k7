<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalFieldsToPendaftaranKpTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('pendaftaran_kp', function (Blueprint $table) {
            $table->integer('sks_koordinator')->nullable()->after('status_pendaftaran');
            $table->text('catatan_koordinator_eligible')->nullable()->after('sks_koordinator');
            $table->text('catatan_kaprodi_eligible')->nullable()->after('catatan_koordinator_eligible');
            $table->text('catatan_doswal_eligible')->nullable()->after('catatan_kaprodi_eligible');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('pendaftaran_kp', function (Blueprint $table) {
            $table->dropColumn([
                'sks_koordinator',
                'catatan_koordinator_eligible',
                'catatan_kaprodi_eligible',
                'catatan_doswal_eligible'
            ]);
        });
    }
}
