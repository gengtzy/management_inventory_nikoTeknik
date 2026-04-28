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
        Schema::create('technicians', function (Blueprint $table) {
        $table->id();
        $table->string('nama_teknisi');
        $table->string('no_hp')->nullable();
        $table->string('spesialisasi')->nullable(); // Contoh: Spesialis Inverter, Cuci Besar, dll
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('technicians');
    }
};
