<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('lineas_pedidos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->decimal('precio');
            $table->integer('stock');
            $table->foreignId('producto_id')->constrained('productos');
            $table->foreignUuid('pedido_id')->constrained('pedidos')->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lineas_pedidos');
    }
};
