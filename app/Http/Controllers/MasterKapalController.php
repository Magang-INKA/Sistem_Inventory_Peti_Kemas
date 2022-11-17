<?php

namespace App\Http\Controllers;

use App\Exports\MasterKapalExport;
use App\Models\MasterKapal;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;

class MasterKapalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('search')){ // Pemilihan jika ingin melakukan pencarian
            $masterKapal = MasterKapal::where('no_kapal', 'like', "%" . $request->search . "%")
            ->orwhere('nama_kapal', 'like', "%" . $request->search . "%")
            ->paginate();
            return view('Kapal.master', compact('masterKapal'))->with('i', (request()->input('page', 1) - 1) * 5);
        } else { // Pemilihan jika tidak melakukan pencarian
            //fungsi eloquent menampilkan data menggunakan pagination
            $masterKapal = MasterKapal::paginate(10); // MenPagination menampilkan 5 data
            return view('Kapal.master', compact('masterKapal'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $masterKapal = MasterKapal::all();
        return view('Kapal.createMaster', compact('masterKapal'));
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
            'no_kapal' => 'required',
            'nama_kapal' => 'required',
        ]);

        $masterKapal = new MasterKapal();
        $masterKapal->no_kapal = $request->get('no_kapal');
        $masterKapal->nama_kapal = $request->get('nama_kapal');
        $masterKapal->save();

        Alert::success('Success', 'Data Master Kapal Berhasil Ditambahkan');
        return redirect()->route('masterKapal.index');
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
    public function edit($kode)
    {
        $masterKapal = MasterKapal::where('no_kapal', $kode)->first();
        return view('Kapal.editMaster', compact('masterKapal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kode)
    {
        $request->validate([
            'no_kapal' => 'required',
            'nama_kapal' => 'required',
        ]);

        $masterKapal = MasterKapal::where('no_kapal', $kode)->first();;
        $masterKapal->no_kapal = $request->get('no_kapal');
        $masterKapal->nama_kapal = $request->get('nama_kapal');
        $masterKapal->save();

        Alert::success('Success', 'Data Master Kapal Berhasil Ditambahkan');
        return redirect()->route('masterKapal.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kode)
    {
        MasterKapal::where('no_kapal', $kode)->delete();
        Alert::success('Success', 'Master Data Kapal berhasil dihapus');
        return redirect()->route('masterKapal.index');
    }

    public function laporan()
    {
        $masterKapal = MasterKapal::all();
        $pdf = PDF::loadview('Kapal.laporanMaster', compact('masterKapal'));
        return $pdf->stream();
    }

    public function laporanExcel(Request $request)
    {
        return Excel::download(new MasterKapalExport, 'masterKapal.xlsx');
    }
}
