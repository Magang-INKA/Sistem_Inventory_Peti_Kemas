<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\Mqtt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function($request, $next){
        if(Gate::allows('manage-MasterData')) return $next($request);
        abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }

    public function index()
    {
        // return view('Dashboard.index');
        // $mqtt_history = Dashboard::with('mqtt')->find($id);
        // return view('Dashboard.index', compact('mqtt_history'));

        $mqtt_dashboard = Dashboard::all();
        $mqtt = Mqtt::all();

        foreach ($mqtt_dashboard as $key => $item) {
            $item['value'] = json_decode($item->value,true);
        }
        foreach ($mqtt as $key => $item) {
            $item['value'] = json_decode($item->value,true);
        }

        $data = array(
            'id' => 'mqtt',
            'id' =>'mqtt_history',
            'mqtt_history' => $mqtt_dashboard,
            'mqtt' => $mqtt
        );

        // return response()->json($data);
        return view('Dashboard.index')->with($data);
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
        //
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
