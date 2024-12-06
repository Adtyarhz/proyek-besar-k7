<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelayakanKpsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('kelayakan_kps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Reference to the mahasiswa
            $table->decimal('nilai_ipk', 4, 2);
            $table->integer('total_sks');
            $table->integer('sks_semester6');
            $table->text('mata_kuliah_tidak_lulus');
            $table->string('bukti_sks_ipk'); // Path to the uploaded file
            $table->enum('status_kelayakan', ['Menunggu', 'Disetujui', 'Ditolak'])->default('Menunggu');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('kelayakan_kps');
    }
}
