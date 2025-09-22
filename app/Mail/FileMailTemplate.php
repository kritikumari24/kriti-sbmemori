<?php

namespace App\Mail;

use App\Services\EmailSentService;
use App\Services\EmailTemplateService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FileMailTemplate extends Mailable
{
    use  SerializesModels; //Queueable,

    protected $data, $file_url, $slug, $id, $footer, $herder;
    public $html_data;
    private $emailTemplateService;
    private $emailSentService;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $data, $email_slug, $id, $file_url = '', $footer_slug = '', $herder_slug = '')
    {
        $this->data = $data;
        $this->slug = $email_slug;
        $this->id = $id;
        $this->file_url = $file_url;
        $this->footer = $footer_slug;
        $this->herder = $herder_slug;
        $this->emailTemplateService = new EmailTemplateService();
        $this->emailSentService = new EmailSentService();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // $mail_data = $this->emailTemplateService->getBySlug($this->slug);

        $mail_content_data = $this->emailSentService->getById($this->id);
        if ($mail_content_data == null)
            return false;
        $this->html_data = $mail_content_data->content;
        // dd("Asd");

        foreach ($this->data as $key => $value) {
            $this->html_data = str_replace($key, $value, $this->html_data);
        }

        if (!empty($this->footer)) {
            $footer_html = $this->emailTemplateService->getBySlug($this->footer)->content;
            $this->html_data = $this->html_data . $footer_html;
        }

        if (!empty($this->herder)) {
            $herder_html = $this->emailTemplateService->getBySlug($this->herder)->content;
            $herder_html = str_replace($key, $value, $herder_html);
            $this->html_data = $herder_html . $this->html_data;
        }

        if (isset($this->file_url) && !empty($this->file_url) && ($this->file_url != '#')) {
            $extension = pathinfo($this->file_url, PATHINFO_EXTENSION);
            // dd($this->file_url);
            return $this->subject($mail_content_data->subject)
                ->from($mail_content_data->from_email, $mail_content_data->from_name)
                ->view('mail.template')
                ->attach($this->file_url, [
                    'as' => 'important.' . $extension
                    // 'mime' => 'application/pdf',
                ]);
        } else {
            return $this->subject($mail_content_data->subject)
                ->from($mail_content_data->from_email, $mail_content_data->from_name)
                ->view('mail.template');
        }
    }
}
