<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LeaveStatusMail extends Mailable
{

    use Queueable, SerializesModels;


    public $leave;


    public function __construct($leave)
    {
        $this->leave = $leave;
    }



    public function build()
    {

        return $this
            ->subject('Leave Request Status Update')
            ->view('emails.leave_status');

    }

}