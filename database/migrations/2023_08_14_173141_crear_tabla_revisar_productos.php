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
        Schema::create('RevisarProductos', function (Blueprint $table) {
            $table->id('IdRevisarProducto');
            $table->unsignedBigInteger('IdMatricularProducto');
            $table->string('AvalRevision', 100);
            $table->date('Fecha');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('RevisarProductos');
    }
};
