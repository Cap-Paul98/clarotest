<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailForQueue extends Mailable
{
    use Queueable, SerializesModels;

    protected $addressee;
    protected $subject;
    protected $shipping_date;
    protected $email_body;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($addressee, $subject, $shipping_date, $email_body)
    {
        $this->addressee = $addressee;
        $this->subject = $subject;
        $this->shipping_date = $shipping_date;
        $this->email_body = $email_body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.template')
                    ->with([
                        'addressee' => $this->addressee,
                        'subject' => $this->subject,
                        'shipping_date' => $this->shipping_date,
                        'email_body' => $this->email_body,
                    ]);
    }
}
