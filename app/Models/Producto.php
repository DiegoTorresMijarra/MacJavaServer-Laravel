<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'imagen',
        'stock',
        'precio',
        'oferta',

        'categoria_id',
    ];

    protected function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }
    public function scopeOferta()
    {
        $this->find('oferta', true);
    }
}
