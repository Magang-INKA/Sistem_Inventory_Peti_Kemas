<?php

namespace App\Http\Controllers;

use App\Exports\PelabuhanExport;
use App\Models\JadwalKapal;
use App\Models\Pelabuhan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;

class PelabuhanController extends Controller
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

    public function select(Request $request)
    {
        $pelabuhan1 = [];

        if ($request->has('q')) {
            $search = $request->q;
            $pelabuhan1 = Pelabuhan::select("kode_pelabuhan", "nama_pelabuhan")
                ->Where('nama_pelabuhan', 'LIKE', "%$search%")
                ->get();
        } else {
            $pelabuhan1 = Pelabuhan::limit(10)->get();
        }
        return response()->json($pelabuhan1);
    }

    public function select2 (Request $request)
    {
        $pelabuhan2 = [];
        $asalID = $request->asalID;
        $tujuanID = $request->tujuanID;

        if ($request->has('q')) {
            $search = $request->q;
            $pelabuhan2=JadwalKapal::select('id','jadwal.asal_pelabuhan_id','pelabuhan.nama_pelabuhan')
                    ->where('pelabuhan.nama_pelabuhan','LIKE',"%$search%")
                    ->join('pelabuhan', 'pelabuhan.kode_pelabuhan', '=', 'rute.asal_pelabuhan_id')
                    ->get();

        } else {
            $pelabuhan2 = JadwalKapal::where('asal_pelabuhan_id', $asalID)
                            ->orWhere('asal_pelabuhan_id',$tujuanID)
                            ->limit(10)
                            ->join('pelabuhan', 'pelabuhan.kode_pelabuhan', '=', 'rute.tujuan_pelabuhan_id')
                            ->get();
        }
        return response()->json($pelabuhan2);
    }

    public function select3 (Request $request)
    {
        $pelabuhan2 = [];
        $asalID = $request->asalID;
        $tujuanID = $request->tujuanID;

        if ($request->has('q')) {
            $search = $request->q;
            $pelabuhan2=Rute::select('id','rute.asal_pelabuhan_id','pelabuhan.nama_pelabuhan')
                    ->where('pelabuhan.nama_pelabuhan','LIKE',"%$search%")
                    ->join('pelabuhan', 'pelabuhan.kode_pelabuhan', '=', 'rute.asal_pelabuhan_id')
                    ->get();

        } else {
            $pelabuhan2 = Rute::select('rute.id','rute.id_trip','trip.nama_trip', 'rute.ETA','rute.ETD','kapal.nama_kapal')
                            ->join('trip', 'trip.id', '=', 'rute.id_trip')
                            ->join('kapal', 'kapal.id', '=', 'trip.id_kapal')
                            ->where('rute.asal_pelabuhan_id', $asalID)
                            ->Where('rute.tujuan_pelabuhan_id',$tujuanID)
                            ->get();
        }
        //dd($pelabuhan2);
        return response()->json($pelabuhan2);
    }

    public function search(Request $request)
    {
        $trip = DB::table('rute');
        if( $request->select_pelabuhan1 && $request->select_pelabuhan2 ){
            $trip = $trip->where('asal_pelabuhan_id', $request->select_pelabuhan1)
                         ->where('tujuan_pelabuhan_id',$request->select_pelabuhan2);
        }
        $trip = $trip->paginate(10);
        return view('booking.index', compact('trip'));
    }


    public function index(Request $request)
    {
        if($request->has('search')){ // Pemilihan jika ingin melakukan pencarian
            $pelabuhan = Pelabuhan::where('id', 'like', "%" . $request->search . "%")
            ->orwhere('nama_pelabuhan', 'like', "%" . $request->search . "%")
            ->paginate();
            return view('Pelabuhan.index', compact('pelabuhan'))->with('i', (request()->input('page', 1) - 1) * 5);
        } else { // Pemilihan jika tidak melakukan pencarian
            //fungsi eloquent menampilkan data menggunakan pagination
            $pelabuhan = Pelabuhan::all(); // MenPagination menampilkan 5 data
            return view('Pelabuhan.index', compact('pelabuhan'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Pelabuhan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
            'kode_pelabuhan' => 'required',
            'nama_pelabuhan' => 'required',
            'alamat' => 'required',
            ]);

            //fungsi eloquent untuk menambah data
            Pelabuhan::create($request->all());

            //jika data berhasil ditambahkan, akan kembali ke halaman utama
            Alert::success('Success', 'Data Pelabuhan Berhasil Ditambahkan');
            return redirect()->route('pelabuhan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //menampilkan detail data dengan menemukan berdasarkan id container
        $pelabuhan = Pelabuhan::find($id);
        return view('Pelabuhan.show', compact('pelabuhan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($kode_pelabuhan)
    {
        //menampilkan detail data dengan menemukan berdasarkan id container untuk diedit
        $pelabuhan = Pelabuhan::where('kode_pelabuhan', $kode_pelabuhan)->first();
        return view('Pelabuhan.edit', compact('pelabuhan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kode_pelabuhan)
    {
        //melakukan validasi data
        $request->validate([
            // 'kode_pelabuhan' => 'required',
            'nama_pelabuhan' => 'required',
            'alamat' => 'required',
            ]);

        //fungsi eloquent untuk mengupdate data inputan kita
        $pelabuhan = Pelabuhan::where('kode_pelabuhan', $kode_pelabuhan)->first();
        // $pelabuhan->kode_pelabuhan = $request->get('kode_pelabuhan');
        $pelabuhan->nama_pelabuhan = $request->get('nama_pelabuhan');
        $pelabuhan->alamat = $request->get('alamat');
        $pelabuhan->save();

        //jika data berhasil diupdate, akan kembali ke halaman utama
            Alert::success('Success', 'Data Pelabuhan Berhasil Diupdate');
            return redirect()->route('pelabuhan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kode)
    {
        //fungsi eloquent untuk menghapus data
        Pelabuhan::where('kode_pelabuhan', $kode)->delete();
        Alert::success('Success', 'Data Pelabuhan berhasil dihapus');
        return redirect()->route('pelabuhan.index');
    }

    public function laporan()
    {
        $pelabuhan = Pelabuhan::all();
        $pdf = PDF::loadview('Pelabuhan.laporan', compact('pelabuhan'));
        return $pdf->stream();
    }

    public function laporanExcel(Request $request)
    {
        return Excel::download(new PelabuhanExport, 'Pelabuhan.xlsx');
    }
}
