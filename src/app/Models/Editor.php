<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Editor extends Model
{
    use HasFactory;

    protected $fillable =[
        'store_id', 'representative_id',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function representative()
    {
        return $this->belongsTo(Representative::class);
    }
}
