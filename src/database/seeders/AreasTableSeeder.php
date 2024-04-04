<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('areas')->insert([
            ['area' => '東京都'],
            ['area' => '大阪府'],
            ['area' => '福岡県'],
            ['area' => '東京都'],
            ['area' => '福岡県'],
            ['area' => '東京都'],
            ['area' => '大阪府'],
            ['area' => '東京都'],
            ['area' => '大阪府'],
            ['area' => '東京都'],
            ['area' => '大阪府'],
            ['area' => '福岡県'],
            ['area' => '東京都'],
            ['area' => '大阪府'],
            ['area' => '東京都'],
            ['area' => '大阪府'],
            ['area' => '東京都'],
            ['area' => '東京都'],
            ['area' => '福岡県'],
            ['area' => '大阪府'],

        ]);
    }
}
