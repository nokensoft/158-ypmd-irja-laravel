<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('cabang_olahraga');
    }

    public function down(): void
    {
        Schema::create('cabang_olahraga', function ($table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->nullable()->unique();
            $table->string('icon')->nullable();
            $table->integer('jumlah_atlet')->default(0);
            $table->integer('jumlah_medali')->default(0);
            $table->text('deskripsi')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
};
