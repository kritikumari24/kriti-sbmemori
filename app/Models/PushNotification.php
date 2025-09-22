<?php

namespace App\Models;

use App\Services\FileService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PushNotification extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $table = 'push_notifications';
}
