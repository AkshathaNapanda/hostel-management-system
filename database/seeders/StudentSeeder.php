<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->insert([
            'name' => 'Vamshy',
            'class' => '4th semester',
            'course' => 'Bca',
            'phone_no' => '7567878657',
            'email' => 'vamshy@gmail.com',
            'address' => 'KRS, Mysore',
            'admission_status' => 1,
        ]);

        DB::table('students')->insert([
            'name' => 'Rukeshma',
            'class' => '4th semester',
            'course' => 'Bca',
            'phone_no' => '6785494567',
            'email' => 'rukku@gmail.com',
            'address' => 'KRS, Mysore',
            'admission_status' => 1,
        ]);
    }
}
