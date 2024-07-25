<?php

namespace Database\Seeders;

use App\Models\Proveedor;
use Illuminate\Database\Seeder;

class ProveedorTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Proveedor::create([
            'nombre' => 'Proveedor Ejemplo',
            'telefono1' => '456123',
            'telefono2' => '456456',
            'articulos' => 'Hierro, Cemento, Tubos, Clavos, Pegamix',
            'dias' => 'jueves, sabado'
        ]);
    }
}
