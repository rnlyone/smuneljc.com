<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('katsudos', function (Blueprint $table) {
            $table->unsignedBigInteger('id_rekomendasi')->nullable()->after('periode');
            $table->json('divisi_undangan')->nullable()->after('id_rekomendasi'); // null = semua divisi diundang
            $table->enum('absensi_fase', ['belum', 'masuk', 'keluar', 'selesai'])->default('belum')->after('absensi');
            $table->timestamp('token_at')->nullable()->after('token');
        });
    }

    public function down()
    {
        Schema::table('katsudos', function (Blueprint $table) {
            $table->dropColumn(['id_rekomendasi', 'divisi_undangan', 'absensi_fase', 'token_at']);
        });
    }
};
