<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Mail\WeeklyCustomerReportMail;
use Illuminate\Support\Facades\Mail;

class SendWeeklyCustomerReport extends Command
{
    protected $signature = 'report:weekly-customers';
    protected $description = 'Send weekly report of newly added customers to managers';

    public function handle()
    {
        $managers = User::where('role', 'manager')->get();

        foreach ($managers as $manager) {

            $customers = User::where('role', 'user')
                ->where('manager_id', $manager->id)
                ->whereBetween('created_at', [
                    now()->subWeek(),
                    now()
                ])
                ->get();

            Mail::to($manager->email)
                ->send(new WeeklyCustomerReportMail($manager, $customers));
        }

        $this->info('Weekly customer reports sent successfully.');
    }
}
