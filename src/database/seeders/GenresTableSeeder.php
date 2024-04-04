<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->insert([
            ['genre' => '寿司'],
            ['genre' => '焼肉'],
            ['genre' => '居酒屋'],
            ['genre' => 'イタリアン'],
            ['genre' => 'ラーメン'],
            ['genre' => '焼肉'],
            ['genre' => 'イタリアン'],
            ['genre' => 'ラーメン'],
            ['genre' => '居酒屋'],
            ['genre' => '寿司'],
            ['genre' => '焼肉'],
            ['genre' => '焼肉'],
            ['genre' => '居酒屋'],
            ['genre' => '寿司'],
            ['genre' => 'ラーメン'],
            ['genre' => '居酒屋'],
            ['genre' => '寿司'],
            ['genre' => '焼肉'],
            ['genre' => 'イタリアン'],
            ['genre' => '寿司'],

        ]);
    }
}
