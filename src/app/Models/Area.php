<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    // モデルが使用するテーブル名を指定
    protected $table = 'areas';

    // モデルの主キーを指定
    protected $primaryKey = 'id';

    // モデルでタイムスタンプを更新しない
    public $timestamps = false;

    // モデルで更新可能なフィールドを指定
    protected $fillable = ['area'];
}

