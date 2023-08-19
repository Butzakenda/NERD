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
        Schema::create('RatificarProductos', function (Blueprint $table) {
            $table->id('IdRatificarProducto');
            $table->unsignedBigInteger('IdRevisarProducto');
            $table->string('ProductoPatentado', 100);
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
        Schema::dropIfExists('RatificarProductos');
    }
};
