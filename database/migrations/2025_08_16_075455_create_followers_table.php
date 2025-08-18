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
        Schema::create('followers', function (Blueprint $table) {
            $table->id();
            $table->foreignId(('user_id'))->constrained()->onDelete('cascade'); //NO HACE FALTA EL USER EN CONSTRAINED PORQUE YA DETECTA QUE HACE REFERENCIA A USERS DE USER_ID
            $table->foreignId(('follower_id'))->constrained('users')->onDelete('cascade'); //EL CONSTRAINED ASIGNA A QUE TABLA HACE REFERENCIA
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('followers');
    }
};
