<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SexSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sexs')->insert([
            'code' => 'B',
            'name' => 'Bé trai'
        ]);
        DB::table('sexs')->insert([
            'code' => 'F',
            'name' => 'Bé trai gái tự do'
        ]);
        DB::table('sexs')->insert([
            'code' => 'G',
            'name' => 'Bé gái'
        ]);
        DB::table('sexs')->insert([
            'code' => 'M',
            'name' => 'Nam'
        ]);
        DB::table('sexs')->insert([
            'code' => 'U',
            'name' => 'Nam nữ tự do'
        ]);
        DB::table('sexs')->insert([
            'code' => 'W',
            'name' => 'Nữ'
        ]);
    }
}
