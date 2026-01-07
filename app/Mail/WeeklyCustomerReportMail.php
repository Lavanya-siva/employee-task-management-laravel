<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WeeklyCustomerReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $manager;
    public $customers;

    protected $csvContent;
    protected $fileName;

    public function __construct($manager, $customers, $csvContent, $fileName)
    {
        $this->manager = $manager;
        $this->customers = $customers;
        $this->csvContent = $csvContent;
        $this->fileName = $fileName;
    }

    public function build()
    {
        return $this->subject('Weekly Customer Report')
            ->view('emails.weekly_customer_report')
            ->attachData(
                $this->csvContent,
                $this->fileName,
                ['mime' => 'text/csv']
            );
    }
}
