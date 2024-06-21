<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGajisTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gajis', function (Blueprint $table) {
            $table->id('id_gaji');
            $table->unsignedBigInteger('id_pegawai');
            $table->decimal('gaji', 10, 2);
            $table->date('tanggal_efektif');
            $table->timestamps();

            // Foreign keys
            $table->foreign('id_pegawai')->references('id_pegawai')->on('pegawais');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gajis');
    }
}
