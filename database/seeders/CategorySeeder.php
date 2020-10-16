<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'id' => 1,
            'name_es' => 'paisajes',
            'description_es' => 'Lugares naturales con belleza propia',
            'name_en' => 'landscapes',
            'description_en' => 'Natural places with their own beauty',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        DB::table('categories')->insert([
            'id' => 2,
            'name_es' => 'cultura',
            'description_es' => 'Cines, Teatros, lugares llenos de cultura para visitar',
            'name_en' => 'culture',
            'description_en' => 'Cinemas, Theaters, places full of culture to visit',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now()
        ]);
    }
}
