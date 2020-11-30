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

        DB::table('spots')->insert([
            'id' => 4,
            'name_es' => 'El Gorosito',
            'description_es' => 'El Monumento al Obrero Petrolero, conocido popular y erróneamente como El Gorosito, es una estatua en homenaje al obrero petrolero creada por el escultor Pablo Daniel Sánchez y el topógrafo José Cifuentes que se encuentra en el cruce de seis importantes avenidas de Caleta Olivia y fue inaugurado en 1969;1​ es el monumento más emblemático de la urbe caletense, usado actualmente como ícono cultural de la ciudad. La plazoleta y el entorno que lo rodean son el núcleo de la mayoría de las manifestaciones, fiestas, conmemoraciones y encuentros populares de la comunidad',
            'name_en' => 'The Gorosito',
            'description_en' => 'The Monument to the Petroleum Worker, popularly and mistakenly known as El Gorosito, is a statue in homage to the oil worker created by the sculptor Pablo Daniel Sánchez and the surveyor José Cifuentes that is located at the intersection of six important avenues of Caleta Olivia and was inaugurated in 1969; 1 is the most emblematic monument in the city of Caleta, currently used as a cultural icon of the city. The square and the surroundings that surround it are the nucleus of most of the demonstrations, parties, commemorations and popular gatherings of the community',
            'address' => 'Av. San Martín 1',
            'latitude' => -46.44177403010689,
            'longitude' => -67.5173484438323,
            'images' => 'gorosito',
            'category_id' => 4,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        DB::table('spots')->insert([
            'id' => 5,
            'name_es' => 'Muelle Caleta Olivia',
            'description_es' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Debitis, esse consequuntur, nemo facilis rem commodi cumque repellat, aliquid labore in molestiae. Quis error quod, asperiores placeat incidunt et? Sunt, vel.',
            'name_en' => 'Caleta Olivia Pier',
            'description_en' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Debitis, esse consequuntur, nemo facilis rem commodi cumque repellat, aliquid labore in molestiae. Quis error quod, asperiores placeat incidunt et? Sunt, vel.',
            'address' => 'Almirante Brown',
            'latitude' => -46.43616892051069,
            'longitude' => -67.51464220163045,
            'images' => 'muelle',
            'category_id' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
        
    }
}
