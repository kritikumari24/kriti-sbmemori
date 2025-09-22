<?php

namespace App\Mail;

use App\Services\EmailTemplateService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;

class ShareProfileMailTemplate extends Mailable
{
    use Queueable, SerializesModels;

    protected $data, $slug, $footer, $herder, $file_url;
    public $html_data;
    private $emailTemplateService;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $data, $email_slug, $file_url = '', $footer_slug = '', $herder_slug = '')
    {
        $this->data = $data;
        $this->slug = $email_slug;
        $this->file_url = $file_url;
        $this->footer = $footer_slug;
        $this->herder = $herder_slug;
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
        if ($mail_data == null)
            return false;

        $this->html_data = $mail_data->content;
        foreach ($this->data as $key => $value) {
            $this->html_data = str_replace($key, $value, $this->html_data);
        }

        if (!empty($this->footer)) {
            $footer_html = $this->emailTemplateService->getBySlug($this->footer)->content;
            $this->html_data = $this->html_data . $footer_html;
        }

        if (!empty($this->herder)) {
            $herder_html = $this->emailTemplateService->getBySlug($this->herder)->content;
            $this->html_data = $herder_html . $this->html_data;
        }
        // $ext = pathinfo($this->file_url, PATHINFO_EXTENSION);
        if (isset($this->file_url) && !empty($this->file_url) && ($this->file_url != '#')) {
            $extension = pathinfo($this->file_url, PATHINFO_EXTENSION);
            return $this->subject($mail_data->subject)
                ->from($mail_data->from_email, $mail_data->from_name)
                ->view('mail.template')
                ->attach($this->file_url, [
                    'as' => 'file.' . $extension
                    // 'mime' => 'application/pdf',
                ]);
        } else {
            return $this->subject($mail_data->subject)
                ->from($mail_data->from_email, $mail_data->from_name)
                ->view('mail.template');
        }
    }
}
