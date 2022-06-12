<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('colors')->insert([
            'code' => 'DEN',
            'name' => 'Đen'
        ]);
        DB::table('colors')->insert([
            'code' => 'DOG',
            'name' => 'Đồng'
        ]);
        DB::table('colors')->insert([
            'code' => 'DOO',
            'name' => 'Đỏ'
        ]);
        DB::table('colors')->insert([
            'code' => 'HOG',
            'name' => 'Hồng'
        ]);
        DB::table('colors')->insert([
            'code' => 'KEM',
            'name' => 'Kem'
        ]);
        DB::table('colors')->insert([
            'code' => 'NAU',
            'name' => 'Nâu'
        ]);
        DB::table('colors')->insert([
            'code' => 'REU',
            'name' => 'Rêu'
        ]);
        DB::table('colors')->insert([
            'code' => 'TRG',
            'name' => 'Trắng'
        ]);
        DB::table('colors')->insert([
            'code' => 'VAG',
            'name' => 'Vàng'
        ]);
        DB::table('colors')->insert([
            'code' => 'XAM',
            'name' => 'Xám'
        ]);
        DB::table('colors')->insert([
            'code' => 'XDD',
            'name' => 'Xanh Dương Đậm'
        ]);
        DB::table('colors')->insert([
            'code' => 'XDG',
            'name' => 'Xanh Dương'
        ]);
        DB::table('colors')->insert([
            'code' => 'XLC',
            'name' => 'Xanh Lá Cây'
        ]);
        DB::table('colors')->insert([
            'code' => 'XMN',
            'name' => 'Xanh Mi Nơ'
        ]);
        DB::table('colors')->insert([
            'code' => 'XNH',
            'name' => 'Xanh'
        ]);
    }
}
