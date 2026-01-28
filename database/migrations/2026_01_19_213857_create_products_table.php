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
        Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('nom');           // PS5 Slim...
        $table->decimal('prix', 8, 2);   // 549.00
        $table->text('image');           // URL de l'image
        $table->text('desc');            // Description courte
        $table->string('categorie');     // 'consoles' ou 'peripheriques'
        $table->timestamps();            // created_at, updated_at
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
