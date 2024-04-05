<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentTimestamp = Carbon::now();

        DB::table('areas')->insert([
            ['area' => '東京都', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['area' => '大阪府', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['area' => '福岡県', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['area' => '東京都', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['area' => '福岡県', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['area' => '東京都', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['area' => '大阪府', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['area' => '東京都', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['area' => '大阪府', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['area' => '東京都', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['area' => '大阪府', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['area' => '福岡県', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['area' => '東京都', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['area' => '大阪府', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['area' => '東京都', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['area' => '大阪府', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['area' => '東京都', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['area' => '東京都', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['area' => '福岡県', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['area' => '大阪府', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],

        ]);
    }
}
