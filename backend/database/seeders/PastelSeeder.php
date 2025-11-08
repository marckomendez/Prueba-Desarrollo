<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pastel;

class PastelSeeder extends Seeder
{
    public function run(): void
    {
        Pastel::create([
            'nombre'            => 'Pastel de Chocolate',
            'descripcion'       => 'Pastel esponjoso con cobertura de chocolate.',
            'preparado_por'     => 'Chef Ana',
            'fecha_creacion'    => now(),
            'fecha_vencimiento' => now()->addDays(7),
        ]);

        Pastel::create([
            'nombre'            => 'Pastel de Vainilla',
            'descripcion'       => 'Clásico pastel de vainilla con crema.',
            'preparado_por'     => 'Chef Juan',
            'fecha_creacion'    => now(),
            'fecha_vencimiento' => now()->addDays(5),
        ]);
    }
}
