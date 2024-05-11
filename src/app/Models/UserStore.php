<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStore extends Model
{
    use HasFactory;

    // モデルに関連するテーブル名を指定する（デフォルトはクラス名の複数形）
    protected $table = 'user_store';

    // モデルの主キーのカラム名を指定する（デフォルトは 'id'）
    protected $primaryKey = null;

    // 主キーが自動増分されるかどうかを示す（デフォルトは true）
    public $incrementing = false;

    // 主キーの型を指定する（デフォルトは 'int'）
    protected $keyType = 'integer';

    // モデルで日付を扱うためのフォーマット
    protected $dateFormat = 'Y-m-d H:i:s';

    // タイムスタンプを更新するかどうかを示す（デフォルトは true）
    public $timestamps = false;

    // モデルの可変項目（ホワイトリスト）
    protected $fillable = [
        'user_id',
        'store_id',
    ];

    // モデルの不可変項目（ブラックリスト）
    protected $guarded = [];

    // モデルの日付属性の配列
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    // ユーザーとの関連付け
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 店舗との関連付け
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
