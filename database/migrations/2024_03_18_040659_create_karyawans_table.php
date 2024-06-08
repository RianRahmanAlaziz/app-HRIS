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
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('jabatan_id');
            $table->string('n_lengkap');
            $table->string('gambar')->nullable();
            $table->string('alamat');
            $table->string('about')->nullable();
            $table->string('saldo')->nullable()->default(12);
            $table->string('no_hp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawans');
    }
};
