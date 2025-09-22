<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmailTemplate extends Model
{
    use HasFactory, Sluggable, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'type',
        'subject',
        'content',
        'from_email',
        'from_name',
        'is_active',
        'record_updated',
        'email_variables',
        'created_at',
        'updated_at'
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
