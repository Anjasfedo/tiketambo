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
        Schema::create('penjualan_tikets', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_pesanan')->unique();
            $table->enum('status', ['pending', 'completed', 'canceled']);
            $table->date('tanggal_pemesanan');
            $table->foreignIdFor(App\Models\Tiket::class, 'tiket_id')->constrained()->onDelete('cascade');
            $table->foreignIdFor(App\Models\User::class, 'user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan_tikets');
    }
};