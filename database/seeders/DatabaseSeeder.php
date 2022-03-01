<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables(['categories', 'spots', 'users']);
        $this->call(CategorySeeder::class);
        $this->call(SpotSeeder::class);
        $this->call(VideoSeeder::class);
        $this->call(PhoneSeeder::class);
        $this->call(UserSeeder::class);
    }

    private function truncateTables(array $tables)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
