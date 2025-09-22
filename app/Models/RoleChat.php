<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleChat extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'vendor_id',
        'last_message',
        'is_file',
        'created_at',
        'updated_at',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }
}
