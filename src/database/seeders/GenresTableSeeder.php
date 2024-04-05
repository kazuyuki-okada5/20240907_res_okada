<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentTimestamp = Carbon::now();

        DB::table('genres')->insert([
            ['genre' => '寿司', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['genre' => '焼肉', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['genre' => '居酒屋', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['genre' => 'イタリアン', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['genre' => 'ラーメン', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['genre' => '焼肉', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['genre' => 'イタリアン', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['genre' => 'ラーメン', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['genre' => '居酒屋', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['genre' => '寿司', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['genre' => '焼肉', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['genre' => '焼肉', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['genre' => '居酒屋', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['genre' => '寿司', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['genre' => 'ラーメン', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['genre' => '居酒屋', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['genre' => '寿司', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['genre' => '焼肉', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['genre' => 'イタリアン', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['genre' => '寿司', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],

        ]);
    }
}
