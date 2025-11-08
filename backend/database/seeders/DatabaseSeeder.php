<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pastel;
use App\Models\Ingrediente;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            IngredienteSeeder::class,
            PastelSeeder::class,
        ]);

        $pastelChocolate = Pastel::where('nombre', 'Pastel de Chocolate')->first();
        $pastelVainilla = Pastel::where('nombre', 'Pastel de Vainilla')->first();

        $harina = Ingrediente::where('nombre', 'Harina')->first();
        $azucar = Ingrediente::where('nombre', 'Azúcar')->first();
        $chocolate = Ingrediente::where('nombre', 'Chocolate')->first();
        $vainilla = Ingrediente::where('nombre', 'Vainilla')->first();

        if ($pastelChocolate && $harina && $azucar && $chocolate) {
            $pastelChocolate->ingredientes()->attach([$harina->id, $azucar->id, $chocolate->id]);
        }

        if ($pastelVainilla && $harina && $azucar && $vainilla) {
            $pastelVainilla->ingredientes()->attach([$harina->id, $azucar->id, $vainilla->id]);
        }
    }
}
