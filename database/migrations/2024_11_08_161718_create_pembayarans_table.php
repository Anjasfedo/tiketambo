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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->string('metode_pembayaran');
            $table->integer('jumlah_tiket');
            $table->decimal('jumlah_bayar', 10, 2);
            $table->date('tanggal_pembayaran')->nullable();
            $table->foreignIdFor(App\Models\Penjualan::class, 'penjualan_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};