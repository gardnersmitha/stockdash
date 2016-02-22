<?php 

namespace App\Helpers\Contracts;
use App\Instance as Instance;
use App\Reminder as Reminder;
use App\Symbol as Symbol;

Interface ReminderRunnerContract

{
	
	public function runAllReminders();

	public function runSymbolReminders(Symbol $symbol);

	public function runReminders($reminders);

	public function muteSymbolFromReminder($reminders);

	public function createInstanceFromReminder($reminders);
	
}