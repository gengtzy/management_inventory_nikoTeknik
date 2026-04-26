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
        Schema::create('items', function (Blueprint $table) {
        $table->id();
        $table->string('kode_barang')->unique();
        $table->string('merek'); // cth: Gree, Daikin
        $table->string('tipe_ac');
        $table->string('pk'); // cth: 0.5, 1, 1.5, 2
        $table->string('freon')->nullable(); // cth: R32
        $table->decimal('ampere', 8, 2)->nullable();
        $table->integer('watt')->nullable();
        $table->integer('stok')->default(0);
        $table->integer('harga_beli_satuan')->default(0);
        $table->integer('harga_jual_satuan')->default(0);
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
