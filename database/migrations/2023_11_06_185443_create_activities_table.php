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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_anggota');
            $table->string('judul_pesan');
            $table->text('isi_pesan');
            $table->string('icon');
            $table->enum('color', ['success', 'warning', 'danger', 'info']);
            $table->boolean('status_read');
            $table->dateTime('datetime');
            $table->timestamps();

            // Definisi foreign key ke tabel Pendaftar (ganti sesuai dengan nama tabel dan kolom yang sesuai)
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
        Schema::dropIfExists('activities');
    }
};
