<?php

namespace App\Http\Controllers;

use App\Exports\TripExport;
use App\Models\MasterKapal;
use App\Models\Pelabuhan;
use App\Models\Trip;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        if($request->has('search')){ // Pemilihan jika ingin melakukan pencarian
            $trip = Trip::where('nama_trip', 'like', "%" . $request->search . "%")
            ->orWhereHas('pelabuhan', function($query) use($search) {
                return $query->where('nama_pelabuhan', 'like', "%" . $search . "%");
            })
            ->paginate();
            return view('Trip.index', compact('trip'))->with('i', (request()->input('page', 1) - 1) * 5);
        } else { // Pemilihan jika tidak melakukan pencarian
            //fungsi eloquent menampilkan data menggunakan pagination
            $trip = Trip::all(); // MenPagination menampilkan 5 data
            return view('Trip.index', compact('trip'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pelabuhan = Pelabuhan::all();
        $kapal = MasterKapal::all();
        return view('Trip.create', compact('pelabuhan', 'kapal'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'nama_trip' => 'required',
            'asal_pelabuhan_id' => 'required',
            'final_pelabuhan_id'  => 'required',
            'id_kapal' => 'required',
        ]);

        $trip = new Trip;
        $trip->nama_trip = $request->get('nama_trip');
        $trip->asal_pelabuhan_id = $request->get('asal_pelabuhan_id');
        $trip->final_pelabuhan_id = $request->get('final_pelabuhan_id');
        $trip->id_kapal = $request->get('id_kapal');
        $trip->save();

        Alert::success('Success', 'Data Trip Berhasil Ditambahkan');
        return redirect()->route('trip.index');
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
        $trip = Trip::find($id);
        $kapal = MasterKapal::all();
        $pelabuhan = Pelabuhan::all();
        return view('Trip.edit', compact('trip','kapal', 'pelabuhan'));
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
        $request->validate([
            'nama_trip' => 'required',
            'asal_pelabuhan_id' => 'required',
            'final_pelabuhan_id'  => 'required',
            'id_kapal' => 'required',
        ]);

        Trip::find($id)->update($request->all());

        Alert::success('Success', 'Data Trip Berhasil Diupdate');
        return redirect()->route('trip.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Trip::find($id)->delete();
        Alert::success('Success', 'Data Trip berhasil dihapus');
        return redirect()->route('trip.index');
    }
    public function laporan()
    {
        $trip = Trip::all();
        $pelabuhan = Pelabuhan::all();
        $masterKapal = MasterKapal::all();
        $pdf = PDF::loadview('Trip.laporan', compact('trip','pelabuhan','masterKapal'));
        return $pdf->stream();
    }

    public function laporanExcel(Request $request)
    {
        return Excel::download(new TripExport, 'Trip.xlsx');
    }
}
