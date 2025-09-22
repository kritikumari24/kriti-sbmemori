<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Services\ServiceTrait;
use App\Models\PushNotification;

class PushNotificationService
{
    use ServiceTrait;
    public $profile_image_directory;

    public function __construct()
    {
        self::$models = 'App\Models\PushNotification';
        $this->profile_image_directory = 'pushNotifications/';
    }
}
