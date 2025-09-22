<?php

namespace App\Jobs;

use App\Mail\FileMailTemplate;
use App\Mail\MailTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class FileMailTemplateQueue implements ShouldQueue
{
    use Dispatchable, Queueable, InteractsWithQueue,  SerializesModels; //;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $mail_key;
    protected $id;
    protected $email;
    protected $bcc_email;
    protected $data;
    protected $file;

    public function __construct($mail_key, $id, $email, $bcc_email, array $array_data, $file_url)
    {
        $this->mail_key = $mail_key;
        $this->id = $id;
        $this->email = $email;
        $this->bcc_email = $bcc_email;
        $this->data = $array_data;
        $this->file = $file_url;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            Mail::to($this->email)->send(new FileMailTemplate($this->data, $this->mail_key, $this->id, $this->file, 'footer', 'header'));
        } catch (\Exception $e) {
            Log::channel('queue')->info("MailTemplateQueue -> handle -> " . $e);
        }
    }
}
