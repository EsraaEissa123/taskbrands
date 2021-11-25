<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
        'location_name','region','country','street', 'brand_id'
    ];
    use HasFactory;
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
