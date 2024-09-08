<?php

namespace App\Imports;

use App\Models\Store;
use App\Models\Area;
use App\Models\Genre;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class StoresImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // バリデーションルールの定義
        $validator = Validator::make($row, [
            'name' => 'required|string|max:50',
            'area' => ['required', Rule::in(['東京都', '大阪府', '福岡県'])],
            'genre' => ['required', Rule::in(['寿司', '焼肉', 'イタリアン', '居酒屋', 'ラーメン'])],
            'store_overview' => 'required|string|max:400',
            'image_url' => ['required', 'url', 'regex:/\.(jpg|jpeg|png)$/i'] // 拡張子の正規表現
        ]);

        // バリデーションをパスしたデータを使用してデータベースに保存する処理
        return new Store([
            'name' => $row['name'],
            'area_id' => $this->getAreaId($row['area']),
            'genre_id' => $this->getGenreId($row['genre']),
            'store_overview' => $row['store_overview'],
            'image_url' => $row['image_url'],
        ]);
    }

    // 地域名からIDを取得するメソッド
    private function getAreaId($area)
    {
        return Area::where('area', $area)->firstOrFail()->id;
    }

    // ジャンル名からIDを取得するメソッド
    private function getGenreId($genre)
    {
        return Genre::where('genre', $genre)->firstOrFail()->id;
    }
}


