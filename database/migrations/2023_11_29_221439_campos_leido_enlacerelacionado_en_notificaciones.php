<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('notificaciones', function (Blueprint $table) {
            $table->unsignedBigInteger('IdSolicitud')->after('IdPQR')->nullable();
            $table->boolean('leido')->default(false)->after('Descripcion');
            $table->string('enlaceRelacionado')->nullable()->after('leido');
        });
    }

    public function down()
    {
        Schema::table('notificaciones', function (Blueprint $table) {
            $table->dropColumn(['IdSolicitud','leido', 'enlaceRelacionado']);
        });
    }
};
