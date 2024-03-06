<?php

use App\Models\Pedido;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('estado', Pedido::$ESTADOS_POSIBLES)->default(Pedido::$ESTADOS_POSIBLES[0]);
            $table->decimal('precioTotal');
            $table->integer('stockTotal');
            $table->string('numero_tarjeta',1000); //los numeros de tarjeta son bastante largos, una vez cifrados
            $table->string('cvc',1000);
            $table->foreignId('user_id')->constrained('users');
            $table->foreignUuid('direccion_personal_id')->constrained('direcciones_personales');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
