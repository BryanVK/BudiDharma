<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengeluaran', function (Blueprint $table) {
            $table->id('pengeluaran_id');
            $table->string('nama_pemohon', 150)->nullable();
            $table->text('keperluan')->nullable();
            $table->decimal('nominal', 15, 2)->default(0);
            $table->string('bukti_pengeluaran', 255)->nullable();
            $table->string('pencatat_dana', 100)->nullable();
            $table->date('tanggal')->nullable();
            $table->string('no_telp', 30)->nullable();
            $table->string('bentuk_pengeluaran', 50)->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengeluaran');
    }
};
