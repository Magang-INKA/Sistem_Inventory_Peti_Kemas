<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Container;
use App\Models\DropPoint;
use App\Models\Pelabuhan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DroppointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $c = DB::table('container')
                ->join('master_container as mc','mc.no_container','=','container.no_container')
                ->select('container.id','container.no_container','mc.kapasitas','mc.suhu_ketetapan')
                ->get();


        return response()->json($c);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dp= DropPoint::create($request->all());
        return response()->json(['message'=>'Success','data'=>$dp]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$dp = DropPoint::find($id);
        $dp_pel = DB::table('drop_point')
        ->select('drop_point.id as droppoint_id','transaksi.id as transaksi_id','booking.no_resi as no_resi','booking.id_container','container.no_container','jadwal.id as id_jadwal','jadwal.tujuan_pelabuhan_id as kdtujuan_pelabuhan','mp2.nama_pelabuhan as tujuan_pelabuhan', 'drop_point.pelabuhan as kdpelabuhan_sekarang', 'mp.nama_pelabuhan as pelabuhan_sekarang')
        ->join('transaksi', 'drop_point.id_transaksi', '=', 'transaksi.id')
        ->join('booking', 'transaksi.id_booking', '=', 'booking.id')
        ->join('container','container.id','=', 'booking.id_container')
        ->join('master_pelabuhan as mp', 'drop_point.pelabuhan', '=', 'mp.kode_pelabuhan')
        ->join('jadwal_kapal as jadwal','jadwal.id','=','booking.id_jadwal')
        ->join('master_pelabuhan as mp2', 'jadwal.tujuan_pelabuhan_id', '=', 'mp2.kode_pelabuhan')
        ->where('booking.id_container', '=', $id)
        ->orderBy('drop_point.id', 'desc')
        ->get();
        // ->orderBy('drop_point.id', 'desc')->first();

        return response()->json($dp_pel);
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
        $dp=DropPoint::find($id);
        $dp->update($request->all());
        return response()->json(['message'=>'Success','data'=>$dp]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dp=DropPoint::find($id);
        $dp->delete();
        return response()->json(['message'=>'Success','data'=>null]);
    }
    public function allList(){
        $dp = DropPoint::all();
        $dp_pel=DropPoint::select('id','drop_point.id_transaksi','drop_point.pelabuhan','master_pelabuhan.nama_pelabuhan','drop_point.keterangan')
                    ->join('master_pelabuhan', 'master_pelabuhan.kode_pelabuhan', '=', 'drop_point.pelabuhan')
                    ->get();

        return response()->json($dp_pel);
    }
    public function pelabuhan(){
        $pelabuhan = Pelabuhan::select('kode_pelabuhan','nama_pelabuhan')->get();

        return response()->json(['message'=>'Success','data'=>$pelabuhan]);
    }
    public function edit($id)
    {
        $dp_pel = DropPoint::find($id);
        //$dp_pel = DB::table('drop_point')

        return response()->json($dp_pel);
    }
}
