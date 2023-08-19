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
        Schema::create('MatricularProductos', function (Blueprint $table) {
            $table->id('IdMatricularProducto');
            $table->string('CopiaRegistro', 100);
            $table->string('PeticionRevision', 100);
            $table->string('SolicitudAlianza', 100);
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
        Schema::dropIfExists('MatricularProductos');
    }
};
