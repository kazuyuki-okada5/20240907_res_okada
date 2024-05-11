<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class ManagersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'aaaa',
            'email' => 'aaaa@co.jp',
            'password' => bcrypt('aaaaaaaa'),
            'role' => 'manager', // ここでロールを指定する
        ]);
    }
}
