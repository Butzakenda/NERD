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
        Schema::create('Administradores', function (Blueprint $table) {
            $table->id('IdAdministrador');
            $table->unsignedBigInteger('user_id');
            $table->string('Nombres', 100);
            $table->string('Apellidos', 100);
            $table->string('Correo', 100);
            $table->string('Tipo', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('Administradores');
    }
};
