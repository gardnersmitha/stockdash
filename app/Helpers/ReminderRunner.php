<?php

namespace app\Helpers;

use Log;
use App\Helpers\Contracts\ReminderRunnerContract;
use App\Reminder as Reminder;
use App\Instance as Instance;
use App\Symbol as Symbol;
use Datetime;

class ReminderRunner implements ReminderRunnerContract
{
	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct(){
       
        $this->reminder = new Reminder;
        
	}

	/**
	 * 
	 * Function to evaluate all reminders in the DB. Intended to be run once a day to process reminders
	 *
	 * @return void
	 */
	public function runAllReminders()
	{
		//get all reminders and send to runReminders
		$reminders = $this->reminder->all();

		if( ! $reminders->isEmpty() ) {

			//dd($reminders);

			Log::info('this ran');
			$this->runReminders($reminders);
		}
	}

	/**
	 * Evaluate the reminders for a given symbol. This function is run every time an instance is udpated using an event hook in App\Providers\ReminderRunnerServiceProvider.php (@boot method)
	 *
	 * @param App\Symbol $symbol
	 * @return void
	 */
	public function runSymbolReminders(Symbol $symbol)
	{
		//get all reminders for a given symbol and run them
		$reminders = $symbol->reminders;

		Log::info('runSymbolReminders(), $symbol:'.$symbol->toJson());

		//send 'em off for processing
		$this->runReminders($reminders);
	}

	/**
	 * Process a collection of reminders and send them to the right methods based on their 'remind_on' date. 
	 Today's reminders get turned into new Instances. 
	 Future reminders check their parent symbol's 'is_muted' property and set it to true if necessary.
	 *
	 * @param Illuminate\Support\Collection $reminders
	 */
	public function runReminders($reminders)
	{	
	
		//get and process the reminders
		Log::info('runReminders(), $reminders:'.$reminders->toJson());

		//Get reminders due today
		$todays_reminders = $reminders->where('remind_on', date('Y-m-d'.' 00:00:00'))->values();

		//Get reminders due in the future
		$future_reminders = $reminders->filter(function($reminder){
			
			if($reminder->remind_on > date('Y-m-d'.' 00:00:00') ) {
				return $reminder;
			}

		});

		//If we have any reminders due today, send them off to become instances
		if( ! $todays_reminders->isEmpty()) {

			Log::info('TR: '.$todays_reminders->toJson());
			$this->createInstanceFromReminder($todays_reminders);

		}

		//For reminders due in the future, make sure we're muting correctly
		if( ! $future_reminders->isEmpty()) {

			Log::info('FR: '.$future_reminders->toJson());
			$this->muteSymbolFromReminder($future_reminders);

		}

		
	}

	public function muteSymbolFromReminder($reminders)
	{

		Log::info('muteSymbolFromReminder, reminders:'.$reminders->toJson());

		$reminders->each(function($reminder){
			
			$symbol = $reminder->symbol;

			if( ! $symbol->is_muted ) {
				
				$symbol->is_muted = 1;

				$symbol->save();
			}

		});
	}

	public function createInstanceFromReminder($reminders)
	{

		Log::info('createInstanceFromReminder, $reminders:'.$reminders->toJson());

		//Save new instance for each reminder;
		$reminders->each(function($reminder) {

			Log::info('reminder:'.$reminder->toJson());
			
			$symbol = $reminder->symbol;

			$instance = new Instance;

			$instance->source_type = 'reminder';

			$instance->source_name = 'Stockdash';

			// Unmute symbol on successful save;
			if( $symbol->instances()->save($instance) ) {

				$symbol->is_muted = false;
				$symbol->save();

			}

			return $reminder;

		});
	}

}