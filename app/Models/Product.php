<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name', 'detail', 'quantity','price','brand_id', 'image_url'

    ];
    public function brands()
    {
        return $this->belongsTo(Brand::class);
    }
    public function branches()
    {
        return $this->belongsToMany(Branch::class);
    }
}
