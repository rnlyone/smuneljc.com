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
        Schema::create('keaktifans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_anggota');
            $table->unsignedBigInteger('id_periode');
            $table->integer('jumlah_absen')->default(0);
            $table->integer('jumlah_izin')->default(0);
            $table->integer('jumlah_th')->default(0);
            $table->integer('jumlah_absen_berturut')->default(0);
            $table->integer('jumlah_izin_berturut')->default(0);
            $table->integer('jumlah_th_berturut')->default(0);
            $table->timestamps();

            // Definisi foreign key ke tabel Pendaftars (ganti sesuai dengan nama tabel dan kolom yang sesuai)
            $table->foreign('id_anggota')->references('id')->on('pendaftars')->onDelete('cascade');

            $table->foreign('id_periode')->references('id')->on('periodes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keaktifans');
    }
};
