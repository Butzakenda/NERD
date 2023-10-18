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
        Schema::table('MatricularProductos', function (Blueprint $table) {
            $table->unsignedBigInteger('IdAdministrador')->after('IdMatricularProducto');
            $table->unsignedBigInteger('IdCliente')->after('IdAdministrador');
            $table->unsignedBigInteger('IdSolicitud')->after('IdCliente');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('MatricularProductos', function (Blueprint $table) {
            $table->unsignedBigInteger('IdAdministrador');
            $table->unsignedBigInteger('IdCliente');
            $table->unsignedBigInteger('IdSolicitud');
        });
    }
};
