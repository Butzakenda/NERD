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
        Schema::table('colaboradores', function (Blueprint $table) {
            $defaultImagePath = 'img/user.png'; 
            $table->string('Foto')->default($defaultImagePath)->after('FechaNacimiento');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('colaboradores', function (Blueprint $table) {
            $table->dropColumn('Foto');
        });
    }
};
