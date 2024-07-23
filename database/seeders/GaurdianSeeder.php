<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GaurdianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('guardians')->insert([
            'name' => 'Akshatha',
            'email' => 'akshathanapanda@gmail.com',
            'address' => 'KRS, Mysore',
            'student_id' => 1
        ]);

        DB::table('guardians')->insert([
            'name' => 'Kiran',
            'email' => 'akshathanapanda@gmail.com',
            'address' => 'KRS, Mysore',
            'student_id' => 1
        ]);
    }
}
