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
        Schema::create('fuentes', function (Blueprint $table) {
            $table->id();
            $table->string('fuente');
            $table->string('pais');
            $table->date('fecha_publicacion');
            $table->string('url')->unique();
            $table->text('detalles')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fuentes');
    }
};
