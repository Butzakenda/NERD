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
        //
        Schema::create('Pqrs', function (Blueprint $table) {
            $table->id('IdPQR');
            $table->unsignedBigInteger('IdColaborador');
            $table->unsignedBigInteger('IdCliente');
            $table->string('Tipo', 30);
            $table->string('Calidad', 12);
            $table->string('Descripcion', 200);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('Pqrs');
    }
};
