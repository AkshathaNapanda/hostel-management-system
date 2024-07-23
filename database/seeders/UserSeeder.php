<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Manish',
            'email' => 'manish@admin',
            'password' => Hash::make('qwerty'),
            'user_role' => 'Super Admin',
        ]);

        DB::table('users')->insert([
            'name' => 'Ronald',
            'email' => 'ronald@admin',
            'password' => Hash::make('qwerty'),
            'user_role' => 'Super Admin',
        ]);

        DB::table('users')->insert([
            'name' => 'Akshatha',
            'email' => 'akshathanapanda@gmail.com',
            'password' => Hash::make('qwerty'),
            'user_role' => 'Admin',
        ]);

	DB::table('users')->insert([
            'name' => 'Vamshy',
            'email' => 'vamshy@gmail.com',
            'password' => Hash::make('qwerty'),
            'user_role' => 'Admin',
        ]);
    DB::table('users')->insert([
            'name' => 'Rakshith',
            'email' => 'rakshith@gmail.com',
            'password' => Hash::make('qwerty'),
            'user_role' => 'Admin',
        ]);
	
    }
}
