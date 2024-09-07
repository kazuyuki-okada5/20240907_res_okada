<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'area_id', 'genre_id', 'store_overview', 'image_url'
    ];

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

   public function area()
    {
        return $this->belongsTo(Area::class);
    }
 
    public function genre()
    {
        return $this->belongsTo(Genre::class);
   }

    public function editors()
    {
        return $this->hasMany(Editor::class);
    }

    // 店舗に関連付けられたユーザーを取得
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_store');
    }

    // 口コミソート機能用
    public function reviews()
    {
    return $this->hasMany(Review::class);
    }

    protected $table = 'stores';

}


