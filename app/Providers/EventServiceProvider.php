<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Helpers\ReminderRunner;
use App\Instance;
use Log;
use DB;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\SomeEvent' => [
            'App\Listeners\EventListener',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //TODO - this is little hacky here, but hey, it works.
        
        //When we update an instance....
        Instance::updating( function($instance) {

            // Run reminders for that instance
            Log::info('Instance update event hook triggered');
            $reminderRunner = new ReminderRunner;
            $reminderRunner->runSymbolReminders($instance->symbol);

            // Update other instances of the same symbol
            //TODO - Actually make this work on same day instances?
            DB::table('instances')->where([
                ['symbol_id',$instance->symbol->id],
                ['action', NULL]
            ])->update(array('action'=>'dismiss','sentiment'=>'neutral','note'=>'Dismissed by reference from instance ID#'.$instance->id));

        });
    }
}