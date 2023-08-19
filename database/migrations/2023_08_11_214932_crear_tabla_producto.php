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
        Schema::create('Productos', function (Blueprint $table) {
            $table->id('IdProducto');
            $table->unsignedBigInteger('IdInscribirProducto');
            $table->unsignedBigInteger('IdDepartamento');
            $table->unsignedBigInteger('IdCiudad');
            $table->unsignedBigInteger('IdCategoria');
            $table->unsignedBigInteger('IdColaborador');
            $table->string('Nombre', 30);
            $table->decimal('Precio', 12,2);
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
        Schema::dropIfExists('Productos');
    }
};
