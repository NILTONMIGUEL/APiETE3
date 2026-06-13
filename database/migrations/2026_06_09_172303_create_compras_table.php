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
       Schema::create('compras', function (Blueprint $table) {
            $table->id(); 
            $table->integer('cliente'); 
            $table->decimal('total', 10, 2); 
            $table->integer('status')->default(1); // Mudado para integer. Ex: 2 significa "comprado"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
