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
        Schema::table('solicitudes', function (Blueprint $table) {
            $table->unsignedBigInteger('IdEntrevista')->after('IdCliente');
            $table->unsignedBigInteger('IdAdministrador')->after('IdEntrevista');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('solicitudes', function (Blueprint $table) {
            $table->dropColumn('IdEntrevista');
            $table->dropColumn('IdAdministrador');
        });
    }
};
