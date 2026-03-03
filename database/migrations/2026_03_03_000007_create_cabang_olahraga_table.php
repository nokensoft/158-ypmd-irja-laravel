<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cabang_olahraga', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->nullable()->unique();
            $table->string('icon')->nullable();
            $table->unsignedInteger('jumlah_atlet')->default(0);
            $table->unsignedInteger('jumlah_medali')->default(0);
            $table->text('deskripsi')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cabang_olahraga');
    }
};
