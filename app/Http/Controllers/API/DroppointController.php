<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DropPoint;
use Illuminate\Http\Request;

class DroppointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$dp = DropPoint::all();
        $dp_pel=DropPoint::select('id','drop_point.id_transaksi','drop_point.pelabuhan','master_pelabuhan.nama_pelabuhan','drop_point.keterangan')
                    ->join('master_pelabuhan', 'master_pelabuhan.kode_pelabuhan', '=', 'drop_point.pelabuhan')
                    ->get();
        return response()->json(['message'=>'Success','data'=>$dp_pel]);
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
        $dp_pel=DropPoint::select('id','drop_point.id_transaksi','master_pelabuhan.kode_pelabuhan','master_pelabuhan.nama_pelabuhan')
                    ->join('master_pelabuhan', 'master_pelabuhan.kode_pelabuhan', '=', 'drop_point.pelabuhan')
                    ->where('id',$id)
                    ->get();
        return response()->json(['message'=>'Success','data'=>$dp_pel]);
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
}
