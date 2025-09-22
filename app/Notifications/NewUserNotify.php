<?php

namespace App\Notifications;

use App\Jobs\MailTemplateQueue;
use App\Services\HelperService;
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

class NewUserNotify extends Notification //implements ShouldQueue
{
    use Queueable;

    protected $icon, $image, $title, $messages, $link_type, $link_id;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->title =  "New User";
        $this->messages =  "New User Register";
        $this->link_type =  'register';
        $this->link_id =  $user->id;
        $this->image = "";
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
        if (config('services.env.notify_services')) {
            array_push($data, FcmChannel::class);
        }
        if (config('services.env.mail_services')) {
            array_push($data, 'mail');
        }
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

    // optional method when using kreait/laravel-firebase:^3.0, this method can be omitted, defaults to the default project
    public function fcmProject($notifiable, $message)
    {
        // return 'Laravel9-Common-Setup'; // name of the firebase project to use
    }
}
