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
        Schema::create('kehadirans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_katsudo');
            $table->unsignedBigInteger('id_anggota');
            $table->enum('status_absen', ['hadir', 'izin', 'sakit', 'absen']);
            $table->timestamps();

            // Definisi foreign key ke tabel Katsudo
            $table->foreign('id_katsudo')->references('id')->on('katsudos')->onDelete('cascade');

            // Definisi foreign key ke tabel Pendaftars
            $table->foreign('id_anggota')->references('id')->on('pendaftars')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kehadirans');
    }
};
