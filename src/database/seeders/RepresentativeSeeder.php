<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Representative; // 代表者モデルの名前に応じて修正してください
use Illuminate\Support\Facades\Hash;

class RepresentativeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Representative::create([
            'name' => 'aaa',
            'email' => 'aaa@co.jp',
            'password' => Hash::make('aaaaaaaa'),
        ]);
    }
}
