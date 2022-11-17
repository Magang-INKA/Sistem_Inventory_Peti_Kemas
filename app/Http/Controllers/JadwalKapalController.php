<?php

namespace App\Http\Controllers;

use App\Models\JadwalKapal;
use App\Models\MasterKapal;
use App\Models\Pelabuhan;
use App\Models\Trip;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class JadwalKapalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('search')){ // Pemilihan jika ingin melakukan pencarian
            $jadwalKapal = JadwalKapal::where('no_kapal', 'like', "%" . $request->search . "%")
            ->orwhere('nama_kapal', 'like', "%" . $request->search . "%")
            ->paginate();
            return view('JadwalKapal.index', compact('jadwalKapal'))->with('i', (request()->input('page', 1) - 1) * 5);
        } else { // Pemilihan jika tidak melakukan pencarian
            //fungsi eloquent menampilkan data menggunakan pagination
            $jadwalKapal = JadwalKapal::paginate(10); // MenPagination menampilkan 5 data
            return view('JadwalKapal.index', compact('jadwalKapal'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jadwalKapal = JadwalKapal::all();
        $trip = Trip::all();
        $kapal = MasterKapal::all();
        return view('JadwalKapal.create', compact('jadwalKapal', 'trip', 'kapal'));
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
            'id_kapal' => 'required',
            'id_trip' => 'required',
            'ETA' => 'required',
            'ETD' => 'required',
        ]);

        $jadwalKapal = new JadwalKapal;
        $jadwalKapal->id_kapal = $request->get('id_kapal');
        $jadwalKapal->id_trip = $request->get('id_trip');
        $jadwalKapal->ETA = $request->get('ETA');
        $jadwalKapal->ETD = $request->get('ETD');
        $jadwalKapal->save();

        Alert::success('Success', 'Data Jadwal Kapal Berhasil Ditambahkan');
        return redirect()->route('JadwalKapal.index');
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
        $jadwalKapal = JadwalKapal::find($id);
        $kapal = MasterKapal::all();
        $pelabuhan = Pelabuhan::all();
        $trip = Trip::all();
        return view('JadwalKapal.edit', compact('jadwalKapal','trip','kapal', 'pelabuhan'));
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
            'id_kapal' => 'required',
            'id_trip' => 'required',
            'ETA' => 'required',
            'ETD' => 'required',
        ]);
        JadwalKapal::find($id)->update($request->all());

        Alert::success('Success', 'Data Jadwal Kapal Berhasil Diupdate');
        return redirect()->route('JadwalKapal.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        JadwalKapal::find($id)->delete();
        Alert::success('Success', 'Data Jadwal Kapal berhasil dihapus');
        return redirect()->route('JadwalKapal.index');
    }
}
