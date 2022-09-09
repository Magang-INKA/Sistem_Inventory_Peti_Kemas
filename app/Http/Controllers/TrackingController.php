<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function tracking(Request $request)
    {
        $search = $request->search;
        if($request->has('search')){
            $mqtt = Dashboard::where('value', 'like', "%" . $search . "%")
            ->orwhere('id', 'like', "%" . $search . "%")
            ->orwhereHas('mqtt', function($query) use($search) {
                return $query->where('topic', '=', $search);
            });
            foreach ($mqtt as $key => $item) {
                $item['value'] = json_decode($item->value,true);
            }

            $data = array(
                'id' =>'mqtt_history',
                'mqtt_history' => $mqtt
            );
            // return response()->json($data);
            return view('Dashboard.tracking')->with($data);
        } else {
            $mqtt = Dashboard::all();

            foreach ($mqtt as $key => $item) {
                $item['value'] = json_decode($item->value,true);
            }

            $data = array(
                'id' =>'mqtt_history',
                'mqtt_history' => $mqtt
            );
            // return response()->json($data);
            return view('Dashboard.tracking')->with($data);
        }

        // $mqtt = Dashboard::all();

        // foreach ($mqtt as $key => $item) {
        //     $item['value'] = json_decode($item->value,true);
        // }

        // $data = array(
        //     'id' =>'mqtt_history',
        //     'mqtt_history' => $mqtt
        // );
        // // return response()->json($data);
        // return view('Dashboard.tracking')->with($data);
    }
}
