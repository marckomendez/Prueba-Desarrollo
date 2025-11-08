<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pastel extends Model
{
    use HasFactory;

    protected $table = 'pasteles';

    protected $fillable = [
        'nombre',
        'descripcion',
        'preparado_por',
        'fecha_creacion',
        'fecha_vencimiento',
    ];

    public function ingredientes()
    {
        return $this->belongsToMany(
            Ingrediente::class,
            'pastel_ingrediente',
            'pastel_id',
            'ingrediente_id'
        )->withTimestamps();
    }
}
