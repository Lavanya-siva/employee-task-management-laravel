<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WeeklyCustomerReportMail extends Mailable
{
    use SerializesModels;

    public $manager;
    public $customers;

    public function __construct($manager, $customers)
    {
        $this->manager = $manager;
        $this->customers = $customers;
    }

    public function build()
    {
        return $this->subject('Weekly New Customers Report')
                    ->view('emails.weekly_customer_report');
    }
}
