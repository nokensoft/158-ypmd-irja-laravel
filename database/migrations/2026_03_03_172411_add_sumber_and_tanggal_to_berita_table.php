<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('berita', function (Blueprint $table) {
            $table->date('tanggal_terbit')->nullable()->after('status');
            $table->string('gambar_url')->nullable()->after('media_id');
            $table->string('sumber_nama')->nullable()->after('konten');
            $table->string('sumber_link')->nullable()->after('sumber_nama');
        });
    }

    public function down(): void
    {
        Schema::table('berita', function (Blueprint $table) {
            $table->dropColumn(['tanggal_terbit', 'gambar_url', 'sumber_nama', 'sumber_link']);
        });
    }
};
