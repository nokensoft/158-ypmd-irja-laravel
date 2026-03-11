<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_donatur');
            $table->string('email')->nullable();
            $table->string('telepon', 20)->nullable();
            $table->string('bank')->nullable();           // bank yang ditransfer ke
            $table->bigInteger('jumlah')->unsigned()->nullable(); // nominal dalam IDR
            $table->text('pesan')->nullable();
            $table->string('bukti_transfer')->nullable(); // storage path to image/PDF
            $table->enum('status', ['pending', 'dikonfirmasi', 'ditolak'])->default('pending');
            $table->text('catatan_admin')->nullable();
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donasi');
    }
};
