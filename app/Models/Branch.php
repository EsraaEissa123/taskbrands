<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
        'branch_name','region','country','street', 'brand_id'
    ];
    use HasFactory;
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
