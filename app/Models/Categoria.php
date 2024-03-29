<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use SoftDeletes, HasFactory;

    public static array $NOMBRES_VALIDOS=['ENTRANTES', 'PRINCIPALES','BEBIDAS', 'POSTRES', 'NUEVO'];

    protected $table = 'categorias';
    protected $fillable = [
        'nombre',
    ];

    public function scopeSearch($query, $search)
    {
        return $query->whereRaw('LOWER(nombre) LIKE ?', ["%" . strtolower($search) . "%"]);
    }
}
