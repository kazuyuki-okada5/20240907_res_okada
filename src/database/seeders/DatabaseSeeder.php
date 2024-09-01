<?php

namespace Database\Seeders;

// use App\Models\Representative\Representative;
use Illuminate\Database\Seeder;

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
        $this->call(ManagersTableSeeder::class);
        $this->call(StoresTableSeeder::class);
        $this->call(RepresentativesTableSeeder::class);
            // 他のシーダーもここに追加する場合があります
    }
}
