<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PastelIngrediente extends Model
{
    protected $table = 'pastel_ingrediente';
    protected $fillable = [
        'pastel_id',
        'ingrediente_id',
    ];
}
