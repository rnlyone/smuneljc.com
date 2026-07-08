<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('rekomendasis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_departemen');
            $table->unsignedBigInteger('id_kaicho');
            $table->unsignedBigInteger('id_periode');
            $table->text('catatan')->nullable();
            $table->enum('status', ['aktif', 'digunakan', 'dicabut'])->default('aktif');
            $table->timestamp('used_at')->nullable();
            $table->timestamps();

            $table->foreign('id_departemen')->references('id')->on('departemens')->onDelete('cascade');
            $table->foreign('id_kaicho')->references('id')->on('pendaftars')->onDelete('cascade');
            $table->foreign('id_periode')->references('id')->on('periodes')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('rekomendasis');
    }
};
