<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatPekerjaansTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('riwayat_pekerjaans', function (Blueprint $table) {
            $table->id('id_riwayat');
            $table->unsignedBigInteger('id_pegawai');
            $table->unsignedBigInteger('id_departemen');
            $table->unsignedBigInteger('id_jabatan');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai')->nullable();
            $table->string('keterangan', 255)->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('id_pegawai')->references('id_pegawai')->on('pegawais');
            $table->foreign('id_departemen')->references('id_departemen')->on('departemens');
            $table->foreign('id_jabatan')->references('id_jabatan')->on('jabatans');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_pekerjaans');
    }
}
