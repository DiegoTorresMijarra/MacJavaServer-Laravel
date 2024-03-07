<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('direcciones_personales', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('pais');
            $table->string('provincia');
            $table->string('municipio');
            $table->string('codigoPostal');
            $table->string('calle');
            $table->string('numero');
            $table->string('portal')->nullable();
            $table->string('infoAdicional')->nullable();
            $table->string('piso')->nullable();
            $table->string('nombre');
            $table->string('apellidos');
            $table->foreignId('user_id')->constrained('users');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('direcciones_personales');
    }
};
