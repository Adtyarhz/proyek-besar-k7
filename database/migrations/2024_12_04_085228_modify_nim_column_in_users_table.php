<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyNimColumnInUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Make 'nim' nullable
            $table->string('nim')->nullable()->change();

            // Similarly, make 'angkatan' and 'doswal' nullable
            $table->string('angkatan')->nullable()->change();
            $table->string('doswal')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Revert 'nim' to non-nullable
            $table->string('nim')->unique()->change();

            // Revert 'angkatan' and 'doswal' to non-nullable with default '-'
            $table->string('angkatan')->default('-')->change();
            $table->string('doswal')->default('-')->change();
        });
    }
}
