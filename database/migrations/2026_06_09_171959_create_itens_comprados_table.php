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
        Schema::create('itens_comprados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('compra_id')->constrained('compras')->onDelete('cascade'); // JUNÇÃO: Vincula ao ID único da tabela compras
            $table->integer('cliente');
            $table->foreignId('produtos_id')->constrained('produtos')->onDelete('cascade');
            $table->integer('quantidade')->default(1);
            $table->decimal('preco_unitario', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itens_comprados');
    }
};
