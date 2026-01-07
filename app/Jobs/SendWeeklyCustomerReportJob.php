<?php

namespace App\Jobs;

use App\Models\User;
use App\Mail\WeeklyCustomerReportMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendWeeklyCustomerReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $manager;

    public function __construct(User $manager)
    {
        $this->manager = $manager;
    }

    public function handle()
    {
        // Get users assigned for that manager
        $customers = User::where('role', 'user')
            ->where('manager_id', $this->manager->id)
            ->whereBetween('created_at', [
                now()->subWeek(),
                now()
            ])
            ->get();

        // Create CSV
        $csvData = [];
        $csvData[] = ['First Name', 'Middle Name', 'Surname', 'Email'];

        foreach ($customers as $customer) {
            $csvData[] = [
                $customer->firstname,
                $customer->middlename,
                $customer->surname,
                $customer->email,
            ];
        }

        $handle = fopen('php://temp', 'r+'); // virtual file in php memory not in disk
        foreach ($csvData as $row) {
            fputcsv($handle, $row); // csv format
        }
        rewind($handle); // pointer to 1st for read purpose
        $csvContent = stream_get_contents($handle);
        fclose($handle);

        $fileName = 'weekly_customers_' . now()->format('Y_m_d') . '.csv';

        //  Send mail
        Mail::to($this->manager->email)->send(
            new WeeklyCustomerReportMail(
                $this->manager,
                $customers,
                $csvContent,
                $fileName
            )
        );
    }
}
