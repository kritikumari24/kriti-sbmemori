<?php

namespace App\Notifications;

use App\Services\HelperService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use NotificationChannels\Fcm\Resources\AndroidConfig;
use NotificationChannels\Fcm\Resources\AndroidFcmOptions;
use NotificationChannels\Fcm\Resources\AndroidNotification;
use NotificationChannels\Fcm\Resources\ApnsConfig;
use NotificationChannels\Fcm\Resources\ApnsFcmOptions;

class PushNotify extends Notification implements ShouldQueue
{
    use Queueable;

    protected $icon, $image, $title, $messages, $link_type, $link_id, $retailer_logo, $retailer;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($pushNotification)
    {
        $this->icon = getFavIconUrl();
        $this->image = $pushNotification->image ? HelperService::getFileUrl('', $pushNotification->image, 'push_notification') : '';
        $this->title =  $pushNotification->title;
        $this->messages =  $pushNotification->messages;
        $this->link_type =  $pushNotification->link_type;
        $this->link_id =  $pushNotification->link_id;

        // dd($this->icon, $this->image, $this->title, $this->messages, $this->link_type, $this->link_id);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', FcmChannel::class];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        // dd($notifiable);
        $screen = 'notification';
        return [
            'notification' => $notifiable->id,
            'title' => $this->title,
            'message' => $this->messages,
            'icon' => $this->icon,
            'image' =>  $this->image,
            'url' => '',
            'link_type' => $this->link_type,
            'link_id' => $this->link_id
        ];
    }


    public function toFcm($notifiable)
    {
        return FcmMessage::create()
            // ->setTopic('promotions')
            ->setData(['link_type' => $this->link_type, 'link_id' => (string)$this->link_id])
            ->setNotification(\NotificationChannels\Fcm\Resources\Notification::create()
                ->setTitle($this->title)
                ->setBody($this->messages)
                ->setImage($this->image))
            ->setAndroid(
                AndroidConfig::create()
                    ->setFcmOptions(AndroidFcmOptions::create()->setAnalyticsLabel('analytics'))
                // ->setNotification(AndroidNotification::create()->setColor('#0A0A0A'))
            )->setApns(
                ApnsConfig::create()
                    ->setFcmOptions(ApnsFcmOptions::create()->setAnalyticsLabel('analytics_ios'))
            );
    }
}
