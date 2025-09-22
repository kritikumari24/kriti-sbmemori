<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    protected $fillable = [
        'title',
        'name',
        'quantity',
        'price',
        'is_active',
        'slug',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source'    => 'name',
                'maxLength' => 150,
                'method'    => null,
                'separator' => '_',
                'unique'    => true,
                'onUpdate'  => false,
            ]
        ];
    }

    public function product_images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
}
