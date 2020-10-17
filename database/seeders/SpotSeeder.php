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
            'address' => 'Villagran Roque Jacinto 1700-1798, Caleta Olivia, Santa Cruz',
            'latitude' => -46.459439,
            'longitude' => -67.501974,
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
            'address' => 'Senador Raúl Almendra 498, Caleta Olivia, Santa Cruz',
            'latitude' => -46.435206,
            'longitude' => -67.521230,
            'images' => 'mechenien',
            'category_id' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
        
    }
}
