<?php

namespace App\Http\Controllers;
use DB;

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
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware(function($request, $next){
    //     if(Gate::allows('manage-MasterData')) return $next($request);
    //     abort(403, 'Anda tidak memiliki cukup hak akses');
    //     });
    // }

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
        $mqtt = Mqtt::find($id);
        $idmqtt = $mqtt->id;
        $no_container = $mqtt->topic;
        $mqtt_history = Dashboard::where('topicid', $idmqtt)->get();
        foreach ($mqtt_history as $key => $item) {
            $item['value'] = json_decode($item->value,true);
        }
        $mqtt['value'] = json_decode($mqtt->value,true);

        $start = Dashboard::where('topicid', $idmqtt)->orderBy('id','desc')->limit(1)->first();
        // foreach ($start as $key => $item) {
        //     $item['value'] = json_decode($item->value,true);
        // }
        $start['value'] = json_decode($start->value,true);

        $pelabuhan = DB::table('drop_point')
        ->select('master_pelabuhan.nama_pelabuhan')
        ->join('master_pelabuhan', 'drop_point.pelabuhan', '=', 'master_pelabuhan.kode_pelabuhan')
        ->join('table_transaksi', 'drop_point.id_transaksi', '=', 'table_transaksi.id')
        ->join('booking', 'table_transaksi.id_booking', '=', 'booking.id')
        ->join('container', 'booking.id_container', '=', 'container.id')
        ->where('container.no_container', '=', $no_container)
        ->orderBy('drop_point.id', 'desc')->limit(1)->first();
        // return $pelabuhan;
        // return response()->json($data);
        return view('Dashboard.show',[
            'idmqtt' => $idmqtt,
            'mqtt_history' => $mqtt_history,
            'mqtt' => $mqtt,
            'start' => $start,
            'pelabuhan' => $pelabuhan
        ]);
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
