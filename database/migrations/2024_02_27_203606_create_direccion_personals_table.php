<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('direccion_personals', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->json('direccion');
            $table->string('nombre');
            $table->string('apellido');
            $table->foreignId('user_id')->constrained('users');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('direccion_personals');
    }
};
