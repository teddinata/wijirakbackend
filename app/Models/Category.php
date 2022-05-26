<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use softDeletes;

    protected $fillable = [
        'name', 'slug', 'image',
    ];

    protected $hidden = [

    ];

    public function getPhotoAttribute($value)
    {
        return url ('storage/' . $value);
    }
}
