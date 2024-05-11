<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Store;
use App\Models\UserStore; // UserStoreモデルを使用する場合

class UserStoreSeeder extends Seeder
{
    public function run()
    {
        // user_id が 6 で store_id が 8 のデータを作成
        UserStore::create([
            'user_id' => 22,
            'store_id' => 8,
        ]);

        // さらに他のデータを作成する場合は同様にして追加する
    }
}