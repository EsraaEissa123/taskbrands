<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'name','detail'
    ];
    use HasFactory;
    public function branches()
    {
        return $this->hasMany(Branch::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
