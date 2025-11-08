<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingrediente extends Model
{
    use HasFactory;

    protected $table = 'ingredientes';

    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_ingreso',
        'fecha_vencimiento',
    ];

    public function pasteles()
    {
        return $this->belongsToMany(
            Pastel::class,
            'pastel_ingrediente',
            'ingrediente_id',
            'pastel_id'
        )->withTimestamps();
    }
}
