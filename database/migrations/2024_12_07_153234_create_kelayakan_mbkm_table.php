<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelayakanMbkmTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('kelayakan_mbkm', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Reference to Mahasiswa
            $table->decimal('nilai_ipk', 4, 2);
            $table->integer('total_sks');
            $table->integer('sks_semester6');
            $table->text('mata_kuliah_tidak_lulus');
            $table->string('bukti_sks_ipk')->nullable(); // File path
            $table->string('status_kelayakan')->default('Menunggu');
            $table->text('catatan_kaprodi')->nullable();
            $table->text('catatan_doswal')->nullable();
            $table->text('catatan_koordinator')->nullable();
            $table->timestamps();

            // Foreign Key Constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('kelayakan_mbkm');
    }
}
