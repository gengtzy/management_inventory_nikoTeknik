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
        Schema::create('sales', function (Blueprint $table) {
        $table->id();
        $table->foreignId('item_id')->constrained('items')->cascadeOnDelete();
        $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
        $table->date('tanggal_jual');
        $table->integer('jumlah_set');
        $table->string('kelengkapan')->nullable(); // Disimpan sebagai string/JSON (cth: "R, O, G")
        $table->string('masa_garansi')->nullable();
        $table->integer('total_harga');
        $table->enum('metode_pembayaran', ['cash', 'transfer', 'tempo']);
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
