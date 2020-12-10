<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'id' => 1,
            'name' => 'admin',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        DB::table('roles')->insert([
            'id' => 2,
            'name' => 'visitor',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Administrador',
            'email' => 'admin@newroute.com',
            'password' => bcrypt('admin'),
            'role_id' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'name' => 'juan',
            'email' => 'juan@gmail.com',
            'password' => bcrypt('networking'),
            'role_id' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        DB::table('users')->insert([
            'id' => 3,
            'name' => 'maria',
            'email' => 'maria@gmail.com',
            'password' => bcrypt('networking'),
            'role_id' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        DB::table('users')->insert([
            'id' => 4,
            'name' => 'pedro',
            'email' => 'pedro@gmail.com',
            'password' => bcrypt('networking'),
            'role_id' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
    }
}
