<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin')->insert([
            'name' => 'mamnager',
            'email' => 'mamnager@gmail.com',
            'password' => 'mamnager1234',
            'role_id' =>'1'

        ]);
    }
}
