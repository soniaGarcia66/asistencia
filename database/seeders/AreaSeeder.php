<?php

namespace Database\Seeders;

use App\Models\Area;
use Database\Factories\AreaFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('areas')->insert([
            'nombre_area' => 'Servidores',
	        'titular' => 'Cesar Ascencio',
	        'informacion' => 'Cloud computing',
	        'telefono' => '1234567'
        ]);

        Area::create([
            'nombre_area' => 'Paginas web',
	        'titular' => 'Sonia Garcia',
	        'informacion' => 'Desarrollo de paginas web',
	        'telefono' => '98765'
        ]);

        Area::factory(20)->create();//Genera 20 registros al llamar a area
    }
}
