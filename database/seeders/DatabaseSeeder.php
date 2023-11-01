<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(30)->create();
        \App\Models\Book::factory(30)->create();
        \App\Models\Category::factory(10)->create();
        // \App\Models\User::factory(10)->create();

        DB::table('users')->insert([
            'name'=>'admin',
            'avatar'=>'ádgdghasvdhas',
            'address'=>'HẢi Phòng   ',
            'phone_number'=>'0942112796',
            'role'=>1,
            'email'=>'admin@gmail.com',
            'password'=>Hash::make('123'),
            
        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
