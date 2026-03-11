<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('kegiatan');

        Schema::create('kdk', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_edisi', 20);
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->date('tanggal_terbit')->nullable();
            $table->string('file_pdf')->nullable(); // storage path to PDF
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kdk');

        Schema::create('kegiatan', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->nullable()->unique();
            $table->text('deskripsi')->nullable();
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai')->nullable();
            $table->string('lokasi')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
};
