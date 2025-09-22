<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{
    use HasFactory, Sluggable;
    protected $fillable = [
        'title',
        'content',
        'slug',
        'is_active',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
                'maxLength' => 150,
                'method'    => null,
                'separator' => '-',
                'unique'    => true,
                'onUpdate'  => false,
            ]
        ];
    }
}
