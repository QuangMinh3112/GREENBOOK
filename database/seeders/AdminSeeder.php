<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name'=>'admin',
            'email'=>'admin1@gmail.com',
            'avatar'=>'1',
            'number_phone'=>'1',
            'gender'=>'1',
            'role_id'=>2,
            'password'=>Hash::make('123')
        ]);
    }
}
