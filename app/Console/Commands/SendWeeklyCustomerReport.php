<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Jobs\SendWeeklyCustomerReportJob;

class SendWeeklyCustomerReport extends Command
{
    protected $signature = 'report:weekly-customers';
    protected $description = 'Send weekly report of newly added customers to managers';

    public function handle()
    {
        $managers = User::where('role', 'manager')->get();

        foreach ($managers as $manager) {
            // dispatch job
            SendWeeklyCustomerReportJob::dispatch($manager);
        }

        $this->info('Weekly customer report jobs dispatched successfully.');
    }
}
