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
        Schema::create('Facturas', function (Blueprint $table) {
            $table->id('IdFactura');
            $table->unsignedBigInteger('IdProducto');
            $table->unsignedBigInteger('IdCliente');
            $table->unsignedBigInteger('IdColaboradorVenta');
            $table->unsignedBigInteger('IdColaboradorCompra');
            $table->DateTime('FechaHora');  
            $table->string('MetodoPago', 200);
            $table->decimal('Total', 12,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('Facturas');
    }
};
