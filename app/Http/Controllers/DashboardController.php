<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Booking;
use App\Models\Dashboard;
use App\Models\MasterContainer;
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

        // $lat_start = Dashboard::select('select value from mqtt_history ORDER BY ts ASC LIMIT 1');
        // $latlon_start = Dashboard::orderBy('ts', 'asc')->first();
        // foreach ($latlon_start as $key => $item) {
        //     $item['value'] = json_decode($latlon_start->value,true);
        // }
        // $latlon_start = $mqtt_dashboard->firstOrFail();
        // $lon_start = Dashboard::select('select'+ 'from users where active = ?', [1]);

        $data = array(
            'id' => 'mqtt',
            'id' =>'mqtt_history',
            // 'id' => 'latlon_start',
            'mqtt_history' => $mqtt_dashboard,
            'mqtt' => $mqtt
            // 'latlon_start' => $latlon_start
        );

        // return $latlon_start;
        // return response()->json($data);
        return view('Dashboard.index')->with($data);
    }

    public function history()
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
        return view('Dashboard.history')->with($data);
    }

    public function historyDetail($id)
    {
        // return view('Dashboard.index');
        // $mqtt_history = Dashboard::with('mqtt')->find($id);
        // return view('Dashboard.index', compact('mqtt_history'));

        $topicid = $id;
        $mqtt_dashboard = Dashboard::where('topicid', $topicid)->get();
        // $mqtt_dashboard = Dashboard::all();
        $mqtt = Mqtt::all();
        $name = Mqtt::find($id);

        foreach ($mqtt_dashboard as $key => $item) {
            $item['value'] = json_decode($item->value,true);
        }
        foreach ($mqtt as $key => $item) {
            $item['value'] = json_decode($item->value,true);
        }

        $data = array(
            'id' => 'mqtt',
            'id' =>'mqtt_history',
            'id' =>'name',
            'mqtt_history' => $mqtt_dashboard,
            'mqtt' => $mqtt,
            'name' => $name
        );

        $dataPoints = [];

        foreach ($mqtt_dashboard as $history) {

            $dataPoints[] = array(
                "name" => $history['name'],
                "data" => [
                    intval($history['term1_marks']),
                    intval($history['term2_marks']),
                    intval($history['term3_marks']),
                    intval($history['term4_marks']),
                ],
            );
        }

        return view('Dashboard.DetailHistory')->with($data);
        // return view ('Dashboard.coba')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function controlling()
    {
        return view('Dashboard.controlling');
    }

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
        $topicid = $id;
        // $id_container = Mqtt::where('id', $id)->get();
        $id_container = Mqtt::find($id);
        foreach ($id_container as $topic_container) {
            $topic_container = $id_container->topic;
        }

        $mqtt_dashboard = Dashboard::where('topicid', $topicid)->get();
        $mqtt = Mqtt::find($id);
        // $idmqtt = $mqtt->id;

        $name = Mqtt::find($id);
        $mqtt_all = Mqtt::all();
        $container = MasterContainer::find($topic_container);

        // $booking = Booking::with('container')->find($id_container);
        // $booking = Booking::where('no_container', $container)->get('id_barang');
        $booking = Booking::where('no_container', $topic_container)->get();
        foreach ($booking as $barang) {
            $barang_id =  $barang->id_barang;
        }
        // $barang = $booking->id_barang;
        // $booking = Booking::find($topic_container);
        // foreach ($booking as $id_barang) {
        //     $id_barang = $booking->id_barang;
        // }
        // $barang = Barang::where('id', $booking)->get('berat');


        foreach ($mqtt_dashboard as $key => $item) {
            $item['value'] = json_decode($item->value,true);
        }
        $mqtt['value'] = json_decode($mqtt->value,true);
        // return $idmqtt;

        $data = array(
            'mqtt_history' => $mqtt_dashboard,
            'mqtt' => $mqtt,
            'name' => $name,
            'mqtt_all' => $mqtt_all,
            'container' => $container,
            'booking' => $booking,
            'barang' => $barang
        );
        return $booking;
        // return response()->json($data);
        // return view('Dashboard.show',[
        //     'idmqtt'=> $idmqtt
        // ]);
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
        Dashboard::find($id)->update($request->all());
        return redirect("Dashboard.index")->withSuccess('AC Control Successfully Updated!');
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
