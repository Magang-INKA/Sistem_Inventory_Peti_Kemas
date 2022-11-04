<?php

namespace App\Http\Controllers;

use App\Exports\KapalExport;
use App\Models\Kapal;
use App\Models\MasterKapal;
use App\Models\Pelabuhan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;

class KapalController extends Controller
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

    public function index(Request $request)
    {
        $search = $request->search;
        if($request->has('search')){ // Pemilihan jika ingin melakukan pencarian
            $kapal = Kapal::where('id', 'like', "%" . $request->search . "%")
            ->orwhere('nama_kapal', 'like', "%" . $request->search . "%")
            ->orwhere('jadwal', 'like', "%" . $request->search . "%")
            ->orWhereHas('pelabuhan', function($query) use($search) {
                return $query->where('nama_pelabuhan', 'like', "%" . $search . "%");
            })
            ->paginate();
            return view('Kapal.index', compact('kapal'))->with('i', (request()->input('page', 1) - 1) * 5);
        } else { // Pemilihan jika tidak melakukan pencarian
            //fungsi eloquent menampilkan data menggunakan pagination
            $kapal = Kapal::paginate(10); // MenPagination menampilkan 5 data
            return view('Kapal.index', compact('kapal'));
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
        return view('Kapal.create', compact('pelabuhan', 'kapal'));
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
        //melakukan validasi data
        $request->validate([
            'id_keberangkatan' => 'required',
            'id_tujuan'  => 'required',
            'no_kapal' => 'required',
            'jadwal' => 'required',
        ]);

        $kapal = new Kapal;
        $kapal->no_kapal = $request->get('no_kapal');
        $kapal->id_keberangkatan = $request->get('id_keberangkatan');
        $kapal->id_tujuan = $request->get('id_tujuan');
        $kapal->jadwal = $request->get('jadwal');
        $kapal->save();

        Alert::success('Success', 'Data Kapal Berhasil Ditambahkan');
        return redirect()->route('kapal.index');
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
        $kapal = Kapal::with('pelabuhan')->find($id);
        return view('Kapal.show', compact('kapal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //menampilkan detail data dengan menemukan berdasarkan id container untuk diedit
        $kapal = Kapal::with('pelabuhan')->find($id);
        // $keluar = BarangKeluar::with('barang')->find($kode);
        $pelabuhan = Pelabuhan::all();
        return view('Kapal.edit', compact('kapal', 'pelabuhan'));
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
        //melakukan validasi data
        $request->validate([
            'id_keberangkatan' => 'required',
            'id_tujuan'  => 'required',
            'nama_kapal' => 'required',
            'jadwal' => 'required',
        ]);
        // $kapal->nama_kapal = $request->get('nama_kapal');
        // $kapal->jadwal = $request->get('jadwal');
        // $kapal->save();
        Kapal::find($id)->update($request->all());
        //fungsi eloquent untuk mengupdate data inputan kita
        // Kapal::find($id)->update($request->all());

        //jika data berhasil diupdate, akan kembali ke halaman utama
        Alert::success('Success', 'Data Kapal Berhasil Diupdate');
        return redirect()->route('kapal.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //fungsi eloquent untuk menghapus data
        Kapal::find($id)->delete();
        Alert::success('Success', 'Data container berhasil dihapus');
        return redirect()->route('kapal.index');
    }

    public function laporan()
    {
        $kapal = Kapal::all();
        $pelabuhan = Pelabuhan::all();
        $pdf = PDF::loadview('Kapal.laporan', compact('kapal', 'pelabuhan'));
        return $pdf->stream();
    }

    public function laporanExcel(Request $request)
    {
        return Excel::download(new KapalExport, 'kapalBarang.xlsx');
    }
}
