<?php

namespace App\Services;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Integer;

class NotificationService
{
    public static function countUnreadByNotifiableId($notifiable_id)
    {
        $data = Notification::where('notifiable_id', $notifiable_id)
            ->whereNull('read_at')
            ->count();
        return $data;
    }

    public static function getByNotifiableId($notifiable_id, $type = 0)
    {
        if ($type) {
            $data = Notification::where('notifiable_id', $notifiable_id)
                ->where('type', 'App\Notifications\PushNotify')
                ->orderBy('created_at', 'DESC');
        } else {
            $data = Notification::where('notifiable_id', $notifiable_id)
                ->where('type', '!=', 'App\Notifications\PushNotify')
                ->orderBy('created_at', 'DESC');
        }
        return $data;
    }

    public static function markAsReadByIds(array $ids)
    {
        $data = Notification::whereIn('id', $ids)
            ->update(['read_at' => now()]);
        return true;
    }

    public static function markAsReadByNotifiableId($id)
    {
        $data = Notification::where('notifiable_id', $id)
            ->update(['read_at' => now()]);
        return true;
    }

    public static function markAsReadByNotifiableType($notifiable_type, $id)
    {
        $data = Notification::where('type', $notifiable_type)
            ->where('notifiable_id', $id)
            ->update(['read_at' => now()]);
        return true;
    }
}
