<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'mobile_no',
        'subject',
        'message',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
