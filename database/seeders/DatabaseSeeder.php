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
        DB::table('users')->insert([
            'name' => 'admin',
            'avatar' => '',
            'address' => '',
            'phone_number' => '',
            'role' => 1,
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456789'),
        ]);
        DB::table('coupons')->insert([
            'name' => 'Mã giảm giá người mới',
            'code' => 'WELCOMETOGREENBOOK',
            'discount' => 10,
            'value' => 'percent',
            'status' => 'public',
        ]);
        DB::table('coupons')->insert([
            'name' => 'Mã giảm giá người hạng bạc',
            'code' => 'SILVERCOUPON',
            'discount' => 20,
            'value' => 'percent',
            'status' => 'public',
            'point_required' => 200,
        ]);
        DB::table('coupons')->insert([
            'name' => 'Mã giảm giá hạng vàng',
            'code' => 'GOLDCOUPON',
            'discount' => 30,
            'value' => 'percent',
            'status' => 'public',
            'point_required' => 200,
        ]);
    }
}
