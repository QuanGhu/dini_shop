<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role')->insert([
            'name' => 'Administrator',
        ]);
        DB::table('role')->insert([
            'name' => 'Operator',
        ]);
        DB::table('role')->insert([
            'name' => 'User Reguler',
        ]);
    }
}
