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
        Schema::create('katsudos', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->unsignedBigInteger('ranah');
            $table->boolean('khusus');
            $table->boolean('approve');
            $table->unsignedBigInteger('pj');
            $table->unsignedBigInteger('periode');
            $table->dateTime('tgl_laksana');
            $table->text('deskripsi');
            $table->string('token')->unique();
            $table->boolean('absensi');
            $table->timestamps();

            // Definisi foreign key ke tabel Departemen (ganti sesuai dengan nama tabel dan kolom yang sesuai)
            $table->foreign('ranah')->references('id')->on('departemens')->onDelete('cascade');

            // Definisi foreign key ke tabel Pendaftar (ganti sesuai dengan nama tabel dan kolom yang sesuai)
            $table->foreign('pj')->references('id')->on('pendaftars')->onDelete('cascade');

            $table->foreign('periode')->references('id')->on('periodes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('katsudos');
    }
};
