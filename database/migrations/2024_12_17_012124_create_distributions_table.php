<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistributionsTable extends Migration
{
    public function up()
    {
        Schema::create('distributions', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // KP atau MBKM
            $table->string('region'); // Jawa, Sumatera, atau Lainnya
            $table->integer('students'); // Jumlah Mahasiswa
            $table->year('year'); // Tahun
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('distributions');
    }
}
