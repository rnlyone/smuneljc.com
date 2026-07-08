<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('kehadirans', function (Blueprint $table) {
            $table->timestamp('masuk_at')->nullable()->after('status_absen');
            $table->timestamp('keluar_at')->nullable()->after('masuk_at');
        });
    }

    public function down()
    {
        Schema::table('kehadirans', function (Blueprint $table) {
            $table->dropColumn(['masuk_at', 'keluar_at']);
        });
    }
};
