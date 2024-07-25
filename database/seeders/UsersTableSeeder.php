<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Ariel Jonatan Ramirez Lopez',
            'email' => 'ariel12jona@gmail.com',
            'password' => bcrypt('jonas123'),
            'role_id' => '1'
        ]);

        User::create([
            'name' => 'Ariel Ramirez',
            'email' => 'ariel20jona@gmail.com',
            'password' => bcrypt('jonas123'),
            'role_id' => '2'
        ]);

        User::create([
            'name' => 'ADMIN',
            'email' => 'admin@decodev.net',
            'password' => bcrypt('decodev123'),
            'role_id' => '1'
        ]);
        User::create([
            'name' => 'ADMIN',
            'email' => 'admin@email.net',
            'password' => bcrypt('admin123'),
            'role_id' => '1'
        ]);
    }
}
