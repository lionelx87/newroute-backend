<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('videos')->insert([
            'id' => 1,
            'spot_id' => 1,
            'link' => 'https://www.youtube.com/watch?v=gObI2N9hXZ4'
        ]);

        DB::table('videos')->insert([
            'id' => 2,
            'spot_id' => 1,
            'link' => 'https://www.youtube.com/watch?v=TzkLBkuAlv0'
        ]);

        DB::table('videos')->insert([
            'id' => 3,
            'spot_id' => 2,
            'link' => 'https://www.youtube.com/watch?v=bMthVYqVCLM'
        ]);
    }
}
