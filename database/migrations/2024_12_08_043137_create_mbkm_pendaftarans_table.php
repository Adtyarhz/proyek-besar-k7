<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMbkmPendaftaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::create('mbkm_pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Relasi ke users
            $table->string('nama');
            $table->string('nim')->unique();
            $table->string('email')->unique();
            $table->text('rencana_pelaksanaan_mbkm');
            $table->string('lokasi_mbkm');
            $table->string('bukti_penerimaan_mbkm')->nullable();
            $table->string('status')->default('Menunggu'); // Status pendaftaran
            $table->text('catatan_dosen_wali')->nullable();
            $table->text('catatan_kaprodi')->nullable();
            $table->text('catatan_koordinator')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mbkm_pendaftarans');
    }
}
