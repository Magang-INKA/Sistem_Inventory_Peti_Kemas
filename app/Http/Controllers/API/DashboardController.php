<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Dashboard;
use App\Models\Mqtt;
use App\Models\User;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $a = Mqtt::all();

        foreach ($a as $key => $item) {
            $item['value'] = json_decode($item->value,true);
        }

        $data = Mqtt::select('mqtt.id','mqtt.topic','mc.kapasitas','mqtt.value')
                        ->join('master_container as mc','mc.no_container','=','mqtt.topic')
                        //->join('mqtt_history as mh', 'mh.topicid', '=', 'mqtt.id')
                        ->get();

                        foreach ($data as $key => $item) {
                            $item['value'] = json_decode($item->value,true);
                        }


        //$data = Mqtt::select('id','topic')->get();
        // return response()->json(['message'=>'Success','data'=>$data]);
        return response()->json($data);
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

        //$mqtt_dashboard = Dashboard::where('topicid', $id)->first();
        // $mqtt = Mqtt::all();
        $topicid = $id;
        // $data = Dashboard::select('id','value')
        $mqtt_dashboard = Dashboard::select('mqtt_history.id','mqtt_history.topicid','m.topic','mc.kapasitas','mqtt_history.value')
        ->join('mqtt as m','m.id','=','mqtt_history.topicid')
        ->join('master_container as mc','mc.no_container','=','m.topic')
        ->where('topicid', $topicid)
        ->orderByDesc('id')->first();

        // foreach ($mqtt_dashboard as $key => $item) {
            $mqtt_dashboard['value'] = json_decode($mqtt_dashboard->value,true);
        // }
        // $mqtt['value'] = json_decode($mqtt_dashboard->value,true);

        return $mqtt_dashboard;
        // return response()->json($mqtt_dashboard);

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

    public function __invoke()
    {
        // ...
    }

    public function getUser(){
        $user = User::all();
        // $user = DB::table('User')->get();
        //echo json_decode($user,JSON_PRETTY_PRINT);
        return response()->json($user);
    }


}
