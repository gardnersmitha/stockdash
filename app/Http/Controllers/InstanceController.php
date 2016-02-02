<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Symbol;
use App\Instance;

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
     * Store a screener item as a new Instance in storage.
     *
     */
    public function storeScreenerItem($item)
    {
        //validate the symbol
        $this->validate($item, [
            'symbol' => 'required|max:8'
        ]);


        $symbol = $this->symbol->firstOrCreate([
            'symbol' => $item->symbol
        ]);

        $instance = $this->instance;

        $instance->source_type = $item->source_type;
        $instance->source_name = $item->source;

        $symbol->instances()->save($instance);

        return('success');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
