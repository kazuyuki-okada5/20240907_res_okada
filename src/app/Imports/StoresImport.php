<?php

namespace App\Imports;

use App\Models\Store;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StoresImport implements ToModel, WithValidation, WithHeadingRow
{
    use Importable;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Store([
            'name' => $row['name'],
            'area_id' => $row['area_id'],
            'genre_id' => $row['genre_id'],
            'store_overview' => $row['store_overview'],
            'image_url' => $row['image_url'],
        ]);
    }

    /**
    * バリデーションルールの設定
    */
    public function rules(): array
    {
        return [
        'name' => 'required|string|max:50',
        'area_id' => 'required|integer|exists:areas,id',
        'genre_id' => 'required|integer|exists:genres,id',
        'store_overview' => 'required|string|max:400',
        'image_url' => 'required|url',
        ];
    }
}

