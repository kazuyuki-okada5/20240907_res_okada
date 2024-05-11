<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class RepresentativesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'aaa',
            'email' => 'aaa@co.jp',
            'password' => bcrypt('aaaaaaaa'),
            'role' => 'representative', // ここでロールを指定する
        ]);
    }
}
