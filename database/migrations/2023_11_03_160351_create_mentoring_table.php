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
        Schema::create('mentoring', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('mahasiswa_id');
            $table->foreign('mahasiswa_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('jadwal_id');
            $table->foreign('jadwal_id')->references('id')->on('jadwal')->onDelete('cascade');
            $table->unsignedBigInteger('angkatan_id');
            $table->foreign('angkatan_id')->references('id')->on('angkatan')->onDelete('cascade');
            $table->text('deskripsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentoring');
    }
};
