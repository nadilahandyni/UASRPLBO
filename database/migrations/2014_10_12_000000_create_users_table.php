<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nip')->unique();
            $table->string('password');
            $table->enum('jabatan', [
                'Kepala Dinas',
                'Kepala Bidang Pengawasan Ketenagakerjaan',
                'Kepala Bidang Hubungan industrial',
                'Kepala Bidang Penempatan dan Pelatihan',
                'Kepala Bidang Transmigrasi',
                'Admin Bidang Pengawasan Ketenagakerjaan',
                'Admin Bidang Hubungan industrial',
                'Admin Bidang Penempatan dan Pelatihan',
                'Admin Bidang Transmigrasi',
                'Admin Sekretariat',
            ]);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
