<?php

namespace App\Http\Controllers;

use App\Exports\PelabuhanExport;
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

    public function index(Request $request)
    {
        if($request->has('search')){ // Pemilihan jika ingin melakukan pencarian
            $pelabuhan = Pelabuhan::where('id', 'like', "%" . $request->search . "%")
            ->orwhere('nama_pelabuhan', 'like', "%" . $request->search . "%")
            ->paginate();
            return view('Pelabuhan.index', compact('pelabuhan'))->with('i', (request()->input('page', 1) - 1) * 5);
        } else { // Pemilihan jika tidak melakukan pencarian
            //fungsi eloquent menampilkan data menggunakan pagination
            $pelabuhan = Pelabuhan::paginate(10); // MenPagination menampilkan 5 data
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
    public function edit($id)
    {
        //menampilkan detail data dengan menemukan berdasarkan id container untuk diedit
        $pelabuhan = Pelabuhan::find($id);
        return view('Pelabuhan.edit', compact('pelabuhan'));
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
            // 'id' => 'required',
            'nama_pelabuhan' => 'required',
            'alamat' => 'required',
            ]);

        //fungsi eloquent untuk mengupdate data inputan kita
            Pelabuhan::find($id)->update($request->all());

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
    public function destroy($id)
    {
        //fungsi eloquent untuk menghapus data
        Pelabuhan::find($id)->delete();
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
        return Excel::download(new PelabuhanExport, 'pelabuhanBarang.xlsx');
    }
}
