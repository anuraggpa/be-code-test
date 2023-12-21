<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmailAlert extends Mailable
{
    use Queueable, SerializesModels;
    public $organisation, $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orgParam, $user)
    {
        $this->organisation = $orgParam;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.organisationAlert.organisationEmail')
                    ->with([
                        'organisation' => $this->organisation,
                        'user' => $this->user]);
    }
}
