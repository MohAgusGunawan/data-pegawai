<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaisTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id('id');
            $table->string('foto_pegawai')->nullable(); 
            $table->string('nama_depan', 50);
            $table->string('nama_belakang', 50);
            $table->date('tanggal_lahir')->nullable();
            $table->date('tanggal_masuk');
            $table->enum('jenis_kelamin', ['Laki', 'Perempuan']);
            $table->string('alamat', 255)->nullable();
            $table->string('kota', 100)->nullable();
            $table->string('provinsi', 100)->nullable();
            $table->string('kode_pos', 10)->nullable();
            $table->string('nomor_telepon', 15)->nullable();
            $table->string('email', 100)->unique();
            $table->string('nip', 20)->unique();
            $table->unsignedBigInteger('id_departemen')->nullable();
            $table->unsignedBigInteger('id_jabatan')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('id_departemen')->references('id_departemen')->on('departemens');
            $table->foreign('id_jabatan')->references('id_jabatan')->on('jabatans');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }
}
