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
            $jadwalKapal = JadwalKapal::where('IMO', 'like', "%" . $request->search . "%")
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
        $pelabuhan = Pelabuhan::all();
        return view('JadwalKapal.create', compact('jadwalKapal', 'trip', 'kapal', 'pelabuhan'));
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
            'id_trip' => 'required',
            'asal_pelabuhan_id' => 'required',
            'tujuan_pelabuhan_id' => 'required',
            'ETA_awal' => 'required',
            'ETD_awal' => 'required',
            'ETA_tujuan' => 'required',
        ]);

        $jadwalKapal = new JadwalKapal;
        $jadwalKapal->id_trip = $request->get('id_trip');
        $jadwalKapal->asal_pelabuhan_id = $request->get('asal_pelabuhan_id');
        $jadwalKapal->tujuan_pelabuhan_id = $request->get('tujuan_pelabuhan_id');
        $jadwalKapal->ETA_awal = $request->get('ETA_awal');
        $jadwalKapal->ETD_awal = $request->get('ETD_awal');
        $jadwalKapal->ETA_tujuan = $request->get('ETA_tujuan');
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
            'id_trip' => 'required',
            'asal_pelabuhan_id' => 'required',
            'tujuan_pelabuhan_id' => 'required',
            'ETA_awal' => 'required',
            'ETD_awal' => 'required',
            'ETA_tujuan' => 'required',
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
    public function select(Request $request)
    {
        $jadwal = [];
        $asalID = $request->asalID;
        $tujuanID = $request->tujuanID;
        if ($request->has('q')) {
            $search = $request->q;
            $jadwal = JadwalKapal::select("id", "asal_pelabuhan_id")
                // ->join('kapal', 'kapal.kode_kapal', '=', 'jadwal_kapal.id_kapal')
                ->where('asal_pelabuhan_id', $asalID)
                ->orWhere('asal_pelabuhan_id', 'LIKE', "%$search%")
                ->get();
        } else {
            $jadwal = JadwalKapal::where('asal_pelabuhan_id', $asalID)
            //->orwhere('tujuan_pelabuhan_id', $tujuanID)
            ->join('pelabuhan', 'pelabuhan.kode_pelabuhan', '=', 'rute.tujuan_pelabuhan_id')
            ->limit(10)
            ->get();
        }
        return response()->json($jadwal);
    }
}
