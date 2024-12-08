<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('pendaftaran_kp', function (Blueprint $table) {
            $table->string('status_pendaftaran', 50)->default('Menunggu')->after('bukti_penerimaan');
        });
    }
    
    public function down()
    {
        Schema::table('pendaftaran_kp', function (Blueprint $table) {
            $table->dropColumn('status_pendaftaran');
        });
    }
    
};
