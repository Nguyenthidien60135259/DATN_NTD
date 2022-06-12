<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_tails')->insert([
            'code' => '00',
            'name' => 'Đuôi 00'
        ]);
        DB::table('product_tails')->insert([
            'code' => '11',
            'name' => 'Đuôi 11'
        ]);
        DB::table('product_tails')->insert([
            'code' => '22',
            'name' => 'Đuôi 22'
        ]);
        DB::table('product_tails')->insert([
            'code' => '33',
            'name' => 'Đuôi 33'
        ]);
        DB::table('product_tails')->insert([
            'code' => '44',
            'name' => 'Đuôi 44'
        ]);
        DB::table('product_tails')->insert([
            'code' => '55',
            'name' => 'Đuôi 55'
        ]);
        DB::table('product_tails')->insert([
            'code' => '66',
            'name' => 'Đuôi 66'
        ]);
        DB::table('product_tails')->insert([
            'code' => '77',
            'name' => 'Đuôi 77'
        ]);
        DB::table('product_tails')->insert([
            'code' => '88',
            'name' => 'Đuôi 88'
        ]);
        DB::table('product_tails')->insert([
            'code' => '99',
            'name' => 'Đuôi 99'
        ]);
    }
}
