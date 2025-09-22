<?php

namespace App\Jobs;

use App\Mail\MailTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MailTemplateQueue //implements ShouldQueue
{
    use Dispatchable,
    //Queueable,
    InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $tries = 25;
    public $maxExceptions = 3;
    protected $mail_key;
    protected $email;
    protected $data;
    protected $footer;
    protected $header;

    public function __construct($mail_key, $email, $array_data = [], $footer = 'footer', $header = 'header')
    {
        $this->mail_key = $mail_key;
        $this->email = $email;
        $this->data = $array_data;
        $this->footer = $footer;
        $this->header = $header;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            Mail::to($this->email)->send(new MailTemplate($this->data, $this->mail_key, $this->footer, $this->header));
        } catch (\Exception $e) {
            Log::channel('mail')->error("MailTemplateQueue -> handle -> " . $e);
        }
    }
}
