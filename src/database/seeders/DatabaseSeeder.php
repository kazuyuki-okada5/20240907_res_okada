<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\ManagerSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(GenresTableSeeder::class);
        $this->call(AreasTableSeeder::class);
        $this->call(ManagerSeeder::class);
            // 他のシーダーもここに追加する場合があります
    }
}
