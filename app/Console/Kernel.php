<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
{
    $schedule->command('birthday:send-emails')
             ->dailyAt('00:00')
             ->withoutOverlapping()  // prevents duplicate runs
             ->runInBackground();    // optimization

    $schedule->command('report:weekly-customers')
             ->weeklyOn(1, '09:00') //monday
             ->withoutOverlapping() // prevents duplicate runs
             ->runInBackground();   // optimization
}


    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
