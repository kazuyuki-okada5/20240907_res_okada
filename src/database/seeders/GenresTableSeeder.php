<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GenresTableSeeder extends Seeder
{
        public function run()
    {
        $currentTimestamp = Carbon::now();

        $genres = [
            '寿司',
            '焼肉',
            '居酒屋',
            'イタリアン',
            'ラーメン',
        ];

        foreach ($genres as $genre) {
            // ジャンルをデータベースに挿入
            DB::table('genres')->insert([
                'genre' => $genre,
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ]);
        }
    }
}
