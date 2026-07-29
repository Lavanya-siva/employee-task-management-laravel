<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class BirthdayWishFromEmployeeMail extends Mailable
{
    public $receiver;
    public $sender;

    public function __construct($receiver, $sender)
    {
        $this->receiver = $receiver;
        $this->sender = $sender;
    }


    public function build()
    {
        return $this->subject('🎉 Happy Birthday!!!')
                    ->view('emails.birthday_wish_from_employee');
    }
}