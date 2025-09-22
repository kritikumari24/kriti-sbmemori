<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatSession extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'chat_id',
        'last_call_time',
        'start_chat_time',
        'end_chat_time',
        'total_time',
        'call_time',
        'is_active',
    ];
}
