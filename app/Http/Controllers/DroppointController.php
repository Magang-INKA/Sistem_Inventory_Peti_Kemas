<?php

namespace App\Http\Controllers;

use App\Models\DropPoint;
use App\Models\MasterKapal;
use App\Models\Pelabuhan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DroppointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dp = DropPoint::all();
        //dd($dp);
        return view('Droppoint.index',compact('dp'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pelabuhan = Pelabuhan::all();
        return view('Droppoint.create',compact('pelabuhan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DropPoint::create($request->all());
        return redirect()->route('droppoint.index');
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
        $dp = DropPoint::find($id);
        $pelabuhan = Pelabuhan::all();

        return view('Droppoint.edit', compact('dp', 'pelabuhan'));
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
        DropPoint::find($id)->update($request->all());
        return redirect()->route('droppoint.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DropPoint::find($id)->delete();
        Alert::success('Success', 'Data Droppoint berhasil dihapus');
        return redirect()->route('droppoint.index');
    }
}
