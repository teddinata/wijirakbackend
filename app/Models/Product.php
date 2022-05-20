<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use softDeletes, Sluggable;

    protected $fillable = [
        'categories_id','name', 'type', 'tags', 'sku', 'weight',
        'description', 'price', 'quantity', 'slug'
    ];

    protected $hidden = [

    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function galleries()
    {
        return $this->hasMany(ProductGallery::class, 'products_id');
    }

    public function categories()
    {
        return $this->belongsTo(Category::class, 'categories_id','id');
    }

    // public function carts()
    // {
    //     return $this->hasMany(Cart::class);
    // }
}
