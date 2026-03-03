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
        Schema::table('users', function (Blueprint $table) {
            $table->string('nomor_hp', 20)->nullable()->after('role');
            $table->string('keterangan_singkat', 255)->nullable()->after('nomor_hp');
            $table->boolean('is_active')->default(true)->after('keterangan_singkat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nomor_hp', 'keterangan_singkat', 'is_active']);
        });
    }
};
