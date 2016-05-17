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
        //Start the screeners running
        $schedule->call(function(ScreenRunnerContract $screen_runner){
            $screen_runner->startScreens();
            Log::info('Screen run initiated by schedule.');
        })->daily()->weekdays()->at('21:30'); //4:30PM EST

        //Fetch the screen results
        $schedule->call(function(ScreenRunnerContract $screen_runner){
            $screen_runner->fetchScreenResults();
            Log::info('Screen results fetch initiated by schedule.');
        })->daily()->weekdays()->at('21:45'); //4:45PM EST

        //Start the screeners running
        $schedule->call(function(ReminderRunnerContract $reminder_runner){
            $reminder_runner->runAllReminders();
            Log::info('Screen run initiated by schedule.');
        })->daily()->weekdays()->at('21:35'); //4:35PM EST
    }
}
