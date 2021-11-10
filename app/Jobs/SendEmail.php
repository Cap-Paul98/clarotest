<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\facades\Mail;
use App\Mail\EmailForQueue;
use App\Email;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $id;
    protected $addressee;
    protected $subject;
    protected $shipping_date;
    protected $email_body;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id, $addressee, $subject, $shipping_date, $email_body)
    {
        $this->id = $id;
        $this->addressee = $addressee;
        $this->subject = $subject;
        $this->shipping_date = $shipping_date;
        $this->email_body = $email_body;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $mail = Email::find($id);
        $mail->status = "ENVIADO";
        $mail->save();
        
        $email = new EmailForQueue($addressee, $subject, $shipping_date, $email_body);
        Mail::to($addressee)->send($email);
    }
}
