<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('berita', 'jumlah_dibaca')) {
            Schema::table('berita', function (Blueprint $table) {
                $table->unsignedInteger('jumlah_dibaca')->default(0)->after('tanggal_terbit');
            });
        }
    }

    public function down(): void
    {
        Schema::table('berita', function (Blueprint $table) {
            $table->dropColumn('jumlah_dibaca');
        });
    }
};
