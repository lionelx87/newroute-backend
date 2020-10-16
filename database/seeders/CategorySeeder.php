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
            'name' => 'paisajes',
            'description' => 'Lugares naturales con belleza propia',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        DB::table('categories')->insert([
            'id' => 2,
            'name' => 'cultura',
            'description' => 'Cines, Teatros, lugares llenos de cultura para visitar',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now()
        ]);
    }
}
