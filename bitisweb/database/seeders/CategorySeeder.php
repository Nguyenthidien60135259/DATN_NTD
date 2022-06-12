<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorys')->insert([
            'code' => 'B',
            'name' => 'Búp bê'
        ]);
        DB::table('categorys')->insert([
            'code' => 'D',
            'name' => 'Dép da, quai chính là da, đế PU, TPR, PVC, Eva'
        ]);
        DB::table('categorys')->insert([
            'code' => 'E',
            'name' => 'Mẫu sử dụng để Eva phun'
        ]);
        DB::table('categorys')->insert([
            'code' => 'F',
            'name' => 'Mẫu để gót rời'
        ]);
        DB::table('categorys')->insert([
            'code' => 'H',
            'name' => 'Hài, dép mang trong nhà'
        ]);
        DB::table('categorys')->insert([
            'code' => 'L',
            'name' => 'Dép lào'
        ]);
        DB::table('categorys')->insert([
            'code' => 'M',
            'name' => 'Mẫu giày Mocasin'
        ]);
        DB::table('categorys')->insert([
            'code' => 'P',
            'name' => 'Đế PU'
        ]);
        DB::table('categorys')->insert([
            'code' => 'R',
            'name' => 'Dép hoặc Sandal sử dụng đế cao su hộp'
        ]);
        DB::table('categorys')->insert([
            'code' => 'S',
            'name' => 'Giày thể thao (Sport)'
        ]);
        DB::table('categorys')->insert([
            'code' => 'T',
            'name' => 'Mẫu dép Sandal, sử dụng để TPR'
        ]);
        DB::table('categorys')->insert([
            'code' => 'V',
            'name' => 'Mẫu giày tây'
        ]);
        DB::table('categorys')->insert([
            'code' => 'X',
            'name' => 'Xốp, đế Eva'
        ]);
        DB::table('categorys')->insert([
            'code' => 'Y',
            'name' => 'Dép hoặc Sandal sử dụng mặt đế Phylon, đế hộp'
        ]);
    }
}
