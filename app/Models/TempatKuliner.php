<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempatKuliner extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
