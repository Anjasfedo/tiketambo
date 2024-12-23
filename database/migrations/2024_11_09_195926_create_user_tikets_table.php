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
        Schema::create('user_tikets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Current owner
            $table->foreignId('tiket_id')->constrained()->onDelete('cascade'); // Ticket reference
            $table->enum('status', ['aktif', 'dijual', 'kedaluwarsa'])->default('dijual');
            $table->decimal('harga_jual', 10, 2); // Sale price for the ticket
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_tickets');
    }
};