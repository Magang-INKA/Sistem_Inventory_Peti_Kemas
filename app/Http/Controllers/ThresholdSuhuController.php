<?php

namespace App\Http\Controllers;

use App\Models\MasterContainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ThresholdSuhuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $result = MasterContainer::find();
        $result = DB::table('master_container')->orderBy('updated_at', 'DESC')->first();
        $container = MasterContainer::all();
        return view('Dashboard.SetThreshold', compact('container', 'result'));
        // return $result;
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
        $request->validate([
            'no_container' => 'required',
            'suhu_ketetapan' => 'required',
        ]);

        $time = Carbon::now();
        $now = $time->toDateTimeString();

        $update = DB::table('master_container')->where('no_container', $request->get('no_container'))->update(array('suhu_ketetapan' => $request->get('suhu_ketetapan'), 'updated_at' => $now));
        // $update->save();

        alert()->success('Success','Set Threshold Suhu berhasil!');
        return redirect()->route('threshold-suhu.index');
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
        // $request->validate([
        //     'no_container' => 'required',
        //     'suhu_ketetapan' => 'required',
        // ]);

        // $update = DB::table('master_container')->where('no_container', $request->get('no_container'))->update(array('suhu_ketetapan' => $request->get('suhu_ketetapan')));
        // // $update->save();

        // alert()->success('Success','Set Threshold Suhu berhasil!');
        // return redirect()->route('threshold-suhu.index');
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
