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
        Schema::table('pendaftars', function (Blueprint $table) {
            $table->unsignedBigInteger('departemen')->default(1);
            $table->unsignedBigInteger('status')->default(1);
            $table->integer('nomor_anggota')->nullable();
            $table->text('foto_anggota')->default('default.jpg');

            // Definisi foreign key ke tabel Departemen
            $table->foreign('departemen')->references('id')->on('departemens')->onDelete('cascade');

            // Definisi foreign key ke tabel Status
            $table->foreign('status')->references('id')->on('statuses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pendaftars', function (Blueprint $table) {
            $table->dropColumn('departemen');
            $table->dropColumn('status');
            $table->dropColumn('nomor_anggota');
            $table->dropColumn('foto_anggota');
        });
    }
};
