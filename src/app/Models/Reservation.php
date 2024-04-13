<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'store_id', 'start_at', 'number_of_people'
    ];

    public function user()
    {
        return $this->beLongsTo(User::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
