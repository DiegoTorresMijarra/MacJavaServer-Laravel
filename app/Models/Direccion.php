<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Direccion extends Model
{
    use SoftDeletes, HasUuids, HasFactory;

    protected $table = 'direcciones';

    protected $fillable = [
        'pais',
        'provincia',
        'municipio',
        'codigoPostal',
        'calle',
        'numero',
        'portal',
        'infoAdicional',
        'piso',
    ];
    public function scopeSearch($query, $search)
    {
        return $query->whereRaw('LOWER(pais) LIKE ?', ["%" . strtolower($search) . "%"])
            ->orWhereRaw('LOWER(provincia) LIKE ?', ["%" . strtolower($search) . "%"])
            ->orWhereRaw('LOWER(municipio) LIKE ?', ["%" . strtolower($search) . "%"])
            ->orWhereRaw('LOWER(calle) LIKE ?', ["%" . strtolower($search) . "%"]);
    }
}
