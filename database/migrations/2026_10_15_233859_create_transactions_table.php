<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['income', 'expense']); // Pemasukan atau Pengeluaran
            $table->string('category'); // Misal: Gaji, Makanan, Tagihan, Transportasi
            $table->decimal('amount', 15, 2); // Jumlah nominal
            $table->date('transaction_date'); // Tanggal transaksi
            $table->text('description')->nullable(); // Catatan tambahan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};