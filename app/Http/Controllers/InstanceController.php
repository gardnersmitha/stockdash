<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Symbol;
use App\Instance;
use App\Reminder;
use Log;
use DB;
use DateTime;
use DateInterval;

class InstanceController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct()
    {
        $this->symbol = new Symbol;
        $this->instance = new Instance;
        $this->reminder = new Reminder;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $instances = Instance::with('symbol')->get();

        return response()->json($instances);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('instance.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate the symbol
        $this->validate($request, [
            'symbol' => 'required|max:8'
        ]);


        $symbol = $this->symbol->firstOrCreate([
            'symbol' => $request->symbol
        ]);

        $instance = $this->instance;
        $instance->source_type = $request->source_type;
        $instance->source_name = $request->source;

        $symbol->instances()->save($instance);

        return redirect('/instance');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       return $this->instance->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // TODO - move validation rules into a model property and make sure we validate here

        // validate the symbol
        // $this->validate($request, [
        //     'symbol' => 'required|max:8'
        // ]); 

        $instance = $this->instance->find($id);

        $instance->fill($request->all());

        if($this->parseInstanceAction($instance)){
            
            $instance->save();
            Log::info('instance updated');
        }

        return redirect('/');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Take the instance action and do the right thing.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function parseInstanceAction(Instance $instance)
    {
        
        //See if the action is a reminder
        if ( str_contains( $instance->action, 'r' ) ) {

            //Explode the string to see what the interval should be (1D, 7D, 30D are options)
            $reminder_interval = strtoupper(trim($instance->action,'r'));

            //dd($reminder_interval);

            //Get today's date as a DateTime object
            $today = new DateTime(date('Y-m-d'));

            //Turn the interval into a DateInterval object
            $interval = new DateInterval('P'.$reminder_interval);

            //Update our reminder obejct with the new date
            $this->reminder->remind_on = $today->add($interval)->format('Y-m-d H:i:s');

            //Manually set our instance id
            //TODO - figure out if there is some way to do this relationally
            $this->reminder->instance_id = $instance->id;

            //Store the reminder.
            return $instance->symbol->reminders()->save($this->reminder);
        }

        //handle dismiss, obvs
        elseif ( str_contains( $instance->action, 'dismiss' ) ) {
           
            return $instance;
        }

    }

    /**
     * Take a collection of instances and dismiss them in bulk.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function bulkDismissInstances(Request $request){
        
        $instances = $request->input('instances');
        $instances_to_dismiss = []; 

        foreach ($instances as $instance) {
            array_push($instances_to_dismiss, $instance['id']);
        }

        Log::info('Bulk dismissing instances.');

        //TODO - switch to use the 'chunk' method and a closure here. Need to handle errors correctly.
        DB::table('instances')->whereIn('id',$instances_to_dismiss)->update(array('action'=>'dismiss','sentiment'=>'neutral','note'=>'Bulk Dismiss'));

        return 'Success. Please reload.';
    }
}
