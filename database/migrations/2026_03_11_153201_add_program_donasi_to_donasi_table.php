<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donasi', function (Blueprint $table) {
            $table->foreignId('program_donasi_id')->nullable()->after('id')->constrained('program_donasi')->nullOnDelete();
            $table->boolean('is_anonim')->default(false)->after('nama_donatur');
        });
    }

    public function down(): void
    {
        Schema::table('donasi', function (Blueprint $table) {
            $table->dropConstrainedForeignId('program_donasi_id');
            $table->dropColumn('is_anonim');
        });
    }
};
