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
        Schema::table('users', function (Blueprint $table) {
            //si se agrega una columna se debe eliminar para el control de versiones
            $table->string('username')->unique; //Se pueden agregar todas las restricciones necesarias
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username'); //si se agrega una columna se debe eliminar para el control de versiones
        });
    }
};
