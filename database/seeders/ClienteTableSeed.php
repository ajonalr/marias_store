<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Seeder;

class ClienteTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cliente::create([
            'id' => 14,
            'nombre' => 'Consumidor Final',
            'nit' => 'CF',
            'direccion' => 'ciudad',
        ]);
    }
}
