<?php

namespace Database\Seeders;

use App\Models\Cierre;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(GrupoSeeder::class);
        $this->call(CierreSeeder::class);
        // \App\Models\User::factory(10)->create();
    }
}
