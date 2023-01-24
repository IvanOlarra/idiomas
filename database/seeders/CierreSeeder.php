<?php

namespace Database\Seeders;

use App\Models\Cierre;
use Illuminate\Database\Seeder;

class CierreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cierre = new Cierre;
        $cierre->id=1;
        $cierre->parcial ='{"parcial1":0,"parcial2":1   }';
        $cierre->estado = 1;

        $cierre->save();

    }
}
