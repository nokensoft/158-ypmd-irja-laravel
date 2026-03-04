<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kunjungan_situs', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address', 45);
            $table->date('tanggal');
            $table->string('url')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->unique(['ip_address', 'tanggal']);
            $table->index('tanggal');
        });

        Schema::table('berita', function (Blueprint $table) {
            $table->unsignedBigInteger('jumlah_dibaca')->default(0)->after('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kunjungan_situs');

        Schema::table('berita', function (Blueprint $table) {
            $table->dropColumn('jumlah_dibaca');
        });
    }
};
