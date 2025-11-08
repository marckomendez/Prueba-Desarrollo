<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ingrediente;

class IngredienteSeeder extends Seeder
{
    public function run(): void
    {
        $ingredientes = [
            [
                'nombre'            => 'Harina',
                'descripcion'       => 'Harina de trigo blanca.',
                'fecha_ingreso'     => now(),
                'fecha_vencimiento' => now()->addMonths(6),
            ],
            [
                'nombre'            => 'Azúcar',
                'descripcion'       => 'Azúcar refinada.',
                'fecha_ingreso'     => now(),
                'fecha_vencimiento' => now()->addMonths(12),
            ],
            [
                'nombre'            => 'Chocolate',
                'descripcion'       => 'Tableta de chocolate oscuro.',
                'fecha_ingreso'     => now(),
                'fecha_vencimiento' => now()->addMonths(3),
            ],
            [
                'nombre'            => 'Vainilla',
                'descripcion'       => 'Esencia de vainilla.',
                'fecha_ingreso'     => now(),
                'fecha_vencimiento' => now()->addMonths(6),
            ],
        ];

        foreach ($ingredientes as $ingrediente) {
            Ingrediente::create($ingrediente);
        }
    }
}
