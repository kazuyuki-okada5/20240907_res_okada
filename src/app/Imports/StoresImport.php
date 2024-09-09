<?php

namespace App\Imports;

use App\Models\Store;
use App\Models\Area;
use App\Models\Genre;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class StoresImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $validator = Validator::make($row, [
            'name' => 'required|string|max:50',
            'area' => ['required', Rule::in(['東京都', '大阪府', '福岡県'])],
            'genre' => ['required', Rule::in(['寿司', '焼肉', 'イタリアン', '居酒屋', 'ラーメン'])],
            'store_overview' => 'required|string|max:400',
            'image_url' => ['required', 'url', 'regex:/\.(jpg|jpeg|png)$/i']
        ]);

        if ($validator->fails()) {
            Log::error('バリデーションエラー: ' . json_encode($validator->errors()));
            throw new \Illuminate\Validation\ValidationException($validator);
        }

        return new Store([
            'name' => $row['name'],
            'area_id' => $this->getAreaId($row['area']),
            'genre_id' => $this->getGenreId($row['genre']),
            'store_overview' => $row['store_overview'],
            'image_url' => $row['image_url'],
        ]);
    }

    private function getAreaId($area)
    {
        return Area::where('area', $area)->firstOrFail()->id;
    }

    private function getGenreId($genre)
    {
        return Genre::where('genre', $genre)->firstOrFail()->id;
    }
}


