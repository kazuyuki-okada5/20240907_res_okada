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

        User::create([
            'name' => 'a',
            'email' => 'a@co.jp',
            'password' => bcrypt('aaaaaaaa'),
            'role' => 'user', // ここでロールを指定する
        ]);

        User::create([
            'name' => 'b',
            'email' => 'b@co.jp',
            'password' => bcrypt('bbbbbbbb'),
            'role' => 'user', // ここでロールを指定する
        ]); 

        User::create([
            'name' => 'c',
            'email' => 'c@co.jp',
            'password' => bcrypt('cccccccc'),
            'role' => 'user', // ここでロールを指定する
        ]); 
    }
}
