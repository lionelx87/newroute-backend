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
            'name' => 'Costanera Caleta Olivia',
            'description' => 'Esta es una descripción sobre el paseo costero de Caleta Olivia.',
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
            'name' => 'Cine Mechenien',
            'description' => 'Esta es una descripción sobre el cine Mechenien de Caleta Olivia.',
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
