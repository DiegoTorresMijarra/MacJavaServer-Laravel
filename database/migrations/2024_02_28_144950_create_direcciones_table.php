<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('direcciones', function (Blueprint $table) {
            $table->uuid('id');
$table->string('pais');
$table->string('provincia');
$table->string('municipio');
$table->string('codigoPostal');
$table->string('calle');
$table->string('numero');
$table->string('portal');
$table->string('infoAdicional');
$table->string('piso');
$table->softDeletes();
$table->timestamps();//
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('direcciones');
    }
};
