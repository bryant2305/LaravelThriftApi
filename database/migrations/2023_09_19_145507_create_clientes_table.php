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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->unsignedBigInteger('servicios_id')->nullable(); // Usar el mismo tipo de datos que en la tabla 'servicios'
            $table->string('email');
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->unsignedBigInteger('encargado_id')->nullable();
            $table->timestamps();

            // Definir la restricción de clave externa
            $table->foreign('servicios_id')->references('id')->on('servicios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};


