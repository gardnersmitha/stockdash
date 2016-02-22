<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Symbol;
use App\Instance;

class SymbolController extends Controller
{

    protected $instance;
    protected $symbol;

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
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'symbol' => 'required|max:8',
        ]);

        $this->symbol()->symbol = $request->symbol;
        $this->symbol()->save();

        
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $symbol
     * @return \Illuminate\Http\Response
     */
    public function show($symbol, Request $request)
    {


        $this->symbol = $this->symbol->with('instances')->where('symbol','=',$symbol)->first();
        
        //dd($request->partial);

        if( $request->partial == 1 ) {

             $html = view('partial.symbol', ['symbol' => $this->symbol])->render();
             return $html;
        }
        else {
            return view('symbol.show', ['symbol' => $this->symbol]);
        }
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
        //
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
     *  
     * Get all reminders for a symbol
     *
     */
    public function setIsMuted(){

        return 'hey';
        //get all reminders
        //$last_reminder = $this->symbol->reminders->pop();

        //dd($last_reminder);

    }
}
