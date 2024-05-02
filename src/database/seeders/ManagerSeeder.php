<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Manager; // 追加

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Manager::create([
            'name' => 'aaaa',
            'email' => 'aaaa@co.jp',
            'password' => Hash::make('aaaaaaaa'),
        ]);
    }
}