<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AreasTableSeeder extends Seeder
{
    public function run()
    {
        $currentTimestamp =Carbon::now();

        $areas = [
            '東京都',
            '大阪府',
            '福岡県',
        ];
      
        foreach ($areas as $area) {
            // エリアをデータベースに挿入
            DB::table('areas')->insert([
                'area' => $area,
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ]);
        }
    }
}
