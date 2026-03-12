<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kdk', function (Blueprint $table) {
            $table->unsignedInteger('jumlah_dibaca')->default(0)->after('file_pdf');
            $table->unsignedInteger('jumlah_unduhan')->default(0)->after('jumlah_dibaca');
        });
    }

    public function down(): void
    {
        Schema::table('kdk', function (Blueprint $table) {
            $table->dropColumn(['jumlah_dibaca', 'jumlah_unduhan']);
        });
    }
};
