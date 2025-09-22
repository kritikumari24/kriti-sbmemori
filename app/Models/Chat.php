<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_first',
        'user_second',
        'last_message',
        'is_file',
        'created_at',
        'updated_at',
    ];

    public function user_first()
    {
        return $this->belongsTo(User::class, 'user_first');
    }
    public function user_second()
    {
        return $this->belongsTo(User::class, 'user_second');
    }
}
