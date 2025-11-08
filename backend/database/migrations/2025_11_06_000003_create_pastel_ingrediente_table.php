<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pastel_ingrediente', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pastel_id')
                ->constrained('pasteles')
                ->onDelete('cascade');
            $table->foreignId('ingrediente_id')
                ->constrained('ingredientes')
                ->onDelete('cascade');
            $table->timestamps();

            $table->unique(['pastel_id', 'ingrediente_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pastel_ingrediente');
    }
};
