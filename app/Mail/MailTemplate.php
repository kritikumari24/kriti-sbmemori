<?php

namespace App\Mail;

use App\Services\EmailTemplateService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailTemplate extends Mailable
{
    use Queueable, SerializesModels;

    private $data, $slug, $footer, $herder;
    public $html_data, $custom_content;
    private $emailTemplateService;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $data, $email_slug, $footer_slug = 'footer', $herder_slug = 'header', $custom_content = null)
    {
        $this->data = $data;
        $this->slug = $email_slug;
        $this->footer = $footer_slug;
        $this->herder = $herder_slug;
        $this->custom_content = $custom_content;
        $this->emailTemplateService = new EmailTemplateService();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail_data = $this->emailTemplateService->getBySlug($this->slug);
        // dd($mail_data);
        if ($mail_data == null)
            return false;

        if (!$this->custom_content) {
            $this->html_data = $mail_data->content;
            foreach ($this->data as $key => $value) {
                $this->html_data = str_replace($key, $value, $this->html_data);
            }
        } else {
            $this->html_data = $this->custom_content;
        }

        // dd($this->data, $this->slug, $this->footer, $this->herder, $mail_data, $mail_data->from_email);
        if (!empty($this->footer)) {
            $footer_html = $this->emailTemplateService->getBySlug($this->footer)->content;
            $this->html_data = $this->html_data . $footer_html;
        }

        if (!empty($this->herder)) {
            $herder_html = $this->emailTemplateService->getBySlug($this->herder)->content;
            $this->html_data = $herder_html . $this->html_data;
        }
        // dd($mail_data->subject, $mail_data->from_email, $mail_data->from_name, $this->html_data);

        return $this->subject($mail_data->subject)
            // ->from($mail_data->from_email, $mail_data->from_name)
            ->from('siddharthmittalgupta01@gmail.com', 'Sam')
            ->to('theemail@gmail.com', 'Me')
            ->view('mail.template');
    }
}
