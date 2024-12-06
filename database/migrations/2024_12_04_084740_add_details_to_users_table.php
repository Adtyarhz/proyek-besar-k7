<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Add new columns
            $table->string('name')->after('id');
            $table->string('email')->unique()->after('username');
            $table->string('nim')->unique()->after('email');
            $table->string('angkatan')->after('nim')->default('-');
            $table->string('doswal')->after('angkatan')->default('-');
            // Removed the 'role' column to prevent duplication
            // $table->string('role')->after('doswal')->default('Mahasiswa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the columns if rolling back
            $table->dropColumn(['name', 'email', 'nim', 'angkatan', 'doswal']);
            // Optionally, drop the 'role' column if you intend to remove it
            // $table->dropColumn('role');
        });
    }
}
