<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('spots')->insert([
            'id' => 1,
            'name_es' => 'Costanera Caleta Olivia',
            'description_es' => 'Lugar ideal para hacer «footing», además de diferentes «canchas» o estadios de fútbol, vóley y básquet que colaboran en el desarrollo disciplinar de sus habitantes. El recorrido continúa divisando con la marea baja, la diversidad de vida marina, observando las algas verdes («musgo de mar» y «lechuga de mar»), que viven sobre las rocas en zonas de baja profundidad; numerosas algas rojas',
            'name_en' => 'Waterfront Caleta Olivia',
            'description_en' => 'An ideal place for footing, as well as different football, volleyball and basketball stadiums that collaborate in the disciplinary development of its inhabitants. At low tide, the tour continues to see the diversity of marine life, observing green algae ("sea moss" and "sea lettuce"), which live on rocks in shallow areas; numerous red algae',
            'address' => 'Av Costanera 598 - 500',
            'latitude' => -46.444105,
            'longitude' => -67.508414,
            'images' => 'costanera',
            'category_id' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        DB::table('spots')->insert([
            'id' => 2,
            'name_es' => 'Cine Mechenien',
            'description_es' => 'En el año 2003 se inauguró en el Centro Cultural Municipal la Asociación Mechenien que administra las instalaciones del cine auditórium manteniendo una programación continua y con estrenos en simultáneos con todo el país. Se han realizado muchas obras: el cambio de butacas, los pisos, adecuación técnica del cine 3D, el cambio total de calderas, el candy bar',
            'name_en' => 'Mechenien Cinema',
            'description_en' => 'In 2003, the Mechenien Association was inaugurated in the Municipal Cultural Center, which manages the auditorium cinema facilities, maintaining a continuous programming and with simultaneous premieres throughout the country. Many works have been carried out: the change of seats, the floors, technical adaptation of the 3D cinema, total change of boilers, the candy bar',
            'address' => 'Patagonia 13',
            'latitude' => -46.435352,
            'longitude' => -67.521189,
            'images' => 'mechenien',
            'category_id' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        DB::table('spots')->insert([
            'id' => 3,
            'name_es' => 'Plaza 20 de Noviembre',
            'description_es' => 'Primera plaza construida en la ciudad de Caleta Olivia',
            'name_en' => 'November 20 place',
            'description_en' => 'First place built in the city of Caleta Olivia',
            'address' => 'Reverendo Padre Jordán y San José Obrero',
            'latitude' => -46.447752,
            'longitude' => -67.522622,
            'images' => 'plaza_20_noviembre',
            'category_id' => 3,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
        
    }
}
