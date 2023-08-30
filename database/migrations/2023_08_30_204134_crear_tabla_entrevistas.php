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
        Schema::create('Entrevistas', function (Blueprint $table) {
            $table->id('IdEntrevista');
            $table->unsignedBigInteger('IdAdministrador');
            $table->string('Entrevistador', 100);
            $table->date('Fecha');
            $table->string('Aval', 200);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('Entrevistas');
    }
};
