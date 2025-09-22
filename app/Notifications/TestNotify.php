<?php

namespace App\Notifications;

use App\Jobs\MailTemplateQueue;
use App\Mail\MailTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use NotificationChannels\Fcm\Resources\AndroidConfig;
use NotificationChannels\Fcm\Resources\AndroidFcmOptions;
use NotificationChannels\Fcm\Resources\AndroidNotification;
use NotificationChannels\Fcm\Resources\ApnsConfig;
use NotificationChannels\Fcm\Resources\ApnsFcmOptions;

class TestNotify extends Notification //implements ShouldQueue
{
    use Queueable;

    protected $image, $icon, $title, $messages, $link_type, $link_id;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user = null)
    {
        $this->title =  "Test Title";
        $this->messages =  "Here is the demo message.";
        $this->link_type =  'test';
        $this->link_id =  '45';
        $this->icon =  '';
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        $data = [];
        array_push($data, 'database');
        array_push($data, FcmChannel::class);
        // array_push($data, 'mail');
        // $data = ['database'];
        // if ($notifiable->is_notify == 1) {
        //     array_push($data, FcmChannel::class);
        // }
        // if ($notifiable->is_email == 1) {
        //     array_push($data, 'mail');
        // }
        return $data;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'user_id' => $notifiable->id,
            'title' => $this->title,
            'message' => $this->messages,
            'url' => '',
            'type' => $this->link_type,
            'icon' => $this->icon
        ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // return (new MailMessage)
        //             ->line('The introduction to the notification.')
        //             ->action('Notification Action', url('/'))
        //             ->line('Thank you for using our application!');
        ///ALL_CHECK_MAIL
        // dd('sdasa');
        $data_array = [
            '{{user_name}}' => $notifiable->name
        ];
        // return (new MailTemplate($data_array, 'community-post-comment'))->to($notifiable->email);
        return MailTemplateQueue::dispatch('community-post-comment', $notifiable->email, $data_array);
    }

    public function toFcm($notifiable)
    {
        return FcmMessage::create()
            ->setData(['link_type' => $this->link_type, 'link_id' => (string)$this->link_id])
            ->setNotification(
                \NotificationChannels\Fcm\Resources\Notification::create()
                    ->setTitle($this->title)
                    ->setBody($this->messages)
                // ->setImage($this->image)
            )
            ->setAndroid(
                AndroidConfig::create()
                    ->setFcmOptions(AndroidFcmOptions::create()->setAnalyticsLabel('analytics'))
                // ->setNotification(AndroidNotification::create()->setColor('#0A0A0A'))
            )->setApns(
                ApnsConfig::create()
                    ->setFcmOptions(ApnsFcmOptions::create()->setAnalyticsLabel('analytics_ios'))
            );
    }

    // optional method when using kreait/laravel-firebase:^3.0, this method can be omitted, defaults to the default project
    public function fcmProject($notifiable, $message)
    {
        // return 'Laravel9-Common-Setup'; // name of the firebase project to use
    }
}
