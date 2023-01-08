<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_datamahasiswa', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->integer('tanggal_lahir');
            $table->integer('no_hp');
            $table->string('email');
            $table->string('agama');
            $table->string('jenis_kelamin');
            $table->integer('nik');
            $table->string('pendidikan_terakir');
            $table->string('pilihan_programstudi1');
            $table->string('pilihan_programstudi2');
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
        Schema::dropIfExists('table_datamahasiswa');
    }
};
