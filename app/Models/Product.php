<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;

class Product extends Model implements HasMedia
{
    protected $fillable = [
        'name', 'detail', 'quantity','price'
    ];
    use HasFactory, HasMediaTrait ;
    public function brands()
    {
        return $this->belongsToMany('App\Models\Brand');
    }
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);
    }
}

