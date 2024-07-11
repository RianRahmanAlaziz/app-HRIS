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
        Schema::create('pengajuan_cutis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karyawan_id');
            $table->foreignId('jeniscuti_id');
            $table->string('k_cuti');
            $table->string('keterangan')->nullable();
            $table->string('status');
            $table->string('surat');
            $table->string('catatan');
            $table->timestamp('tgl_mulai')->nullable();
            $table->timestamp('tgl_selesai')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_cutis');
    }
};
