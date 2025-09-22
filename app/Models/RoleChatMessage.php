<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleChatMessage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'chat_id',
        'sender_id',
        'sender_type',
        'message',
        'is_file',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
