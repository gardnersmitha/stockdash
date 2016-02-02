<?php

namespace App\Console;

use Log;
use App\Helpers\Contracts\ScreenRunnerContract;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function(ScreenRunnerContract $screen_runner){
            $screen_runner->runScreens();
            Log::info('ScreenRunner executed');
        })->daily()->weekdays()->at('18:02');
    }
}
