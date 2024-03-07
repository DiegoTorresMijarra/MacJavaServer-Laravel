<?php

use App\Models\Producto;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique('productos_nombre_unique');
            $table->string('descripcion');
            $table->string('imagen')->default(Producto::$IMAGE_DEFAULT);
            $table->integer('stock')->default(0);;
            $table->decimal('precio')->default(0);;
            $table->boolean('oferta')->default(false);
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');;
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
