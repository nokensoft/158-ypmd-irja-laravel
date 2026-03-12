<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kdk', function (Blueprint $table) {
            $table->foreignId('media_id')->nullable()->after('file_pdf')->constrained('media')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('kdk', function (Blueprint $table) {
            $table->dropConstrainedForeignId('media_id');
        });
    }
};
