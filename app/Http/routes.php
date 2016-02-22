<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Helpers\Contracts\ScreenRunnerContract;
use App\Helpers\Contracts\ReminderRunnerContract;

Route::get('/', function () {

    return view('dashboard');

});

Route::get('/runscreens', function (ScreenRunnerContract $screenrunner) {

	$screens = $screenrunner->runScreens();

    return view('app', ['screens']);

});

Route::get('/runreminders', function (ReminderRunnerContract $reminderrunner) {

	$reminders = $reminderrunner->runAllReminders();

    dd($reminders);

});

Route::resource('instance','InstanceController');
Route::resource('symbol','SymbolController');
Route::resource('reminder','ReminderController');


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    
});
