<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categoria::create([
            'nombre' => 'UNDAD',
            'tipo' => 'UNIDAD',
        ]);

        Categoria::create([
            'nombre' => 'CAJA',
            'tipo' => 'CAJA',
        ]);

    }
}
