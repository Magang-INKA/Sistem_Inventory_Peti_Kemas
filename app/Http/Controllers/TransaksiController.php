<?php

namespace App\Http\Controllers;

use App\Exports\TransaksiExport;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use PDF;

class TransaksiController extends Controller
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
            $transaksi = Transaksi::where('kode', 'like', "%" . $request->search . "%")
            ->orwhere('nama', 'like', "%" . $request->search . "%")
            ->orwhere('alamat', 'like', "%" . $request->search . "%")
            ->orwhere('telp', 'like', "%" . $request->search . "%")
            ->orwhere('kota', 'like', "%" . $request->search . "%")
            ->orwhere('penyedia', 'like', "%" . $request->search . "%")
            ->paginate();
            return view('Transaksi.index', compact('transaksi'))->with('i', (request()->input('page', 1) - 1) * 5);
        } else { // Pemilihan jika tidak melakukan pencarian
            //fungsi eloquent menampilkan data menggunakan pagination
            $transaksi = Transaksi::paginate(10); // MenPagination menampilkan 5 data
            return view('Transaksi.index', compact('transaksi'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $num = Transaksi::orderBy('kode','desc')->count();
        $dataCode = Transaksi::orderBy('kode','desc')->first();
        if ($num == 0) {
            $code = 'SUP001';
        }
        else{
            $c = $dataCode->kode;
            $code = substr($c, 3)+1;
            $code = "SUP00".$code;
        }
        return view('Transaksi.create',compact('code'));
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
            'kode' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'telp' => 'required',
            'kota' => 'required',
            'penyedia' => 'required',
            ]);

            //fungsi eloquent untuk menambah data
            Transaksi::create($request->all());

            //jika data berhasil ditambahkan, akan kembali ke halaman utama
            Alert::success('Success', 'Data Transaksi Berhasil Ditambahkan');
            return redirect()->route('transaksi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($kode)
    {
        //menampilkan detail data dengan menemukan berdasarkan kode transaksi
        $transaksi = Transaksi::find($kode);
        return view('Transaksi.show', compact('transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($kode)
    {
        //menampilkan detail data dengan menemukan berdasarkan kode transaksi untuk diedit

        $transaksi = Transaksi::find($kode);
        $var = (string)QrCode::format('svg')->margin(0)->size(200)->generate($transaksi);
        // return response($image)->header('Content-type','image/png');
        // $output_file = '/img/qr-code/img-' . time() . '.png';
        // Storage::disk('local')->put($output_file, $image);
        return view('Transaksi.edit', compact('transaksi','var'));
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
        //melakukan validasi data
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'telp' => 'required',
            'kota' => 'required',
            'penyedia' => 'required',
            ]);

        //fungsi eloquent untuk mengupdate data inputan kita
            Transaksi::find($kode)->update($request->all());

        //jika data berhasil diupdate, akan kembali ke halaman utama
            Alert::success('Success', 'Data Transaksi Berhasil Diupdate');
            return redirect()->route('transaksi.index');
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
        Transaksi::find($kode)->delete();
        Alert::success('Success', 'Data Transaksi Berhasil Dihapus');
        return redirect()->route('transaksi.index');
    }

    public function laporan()
    {
        $transaksi = Transaksi::all();
        $pdf = PDF::loadview('Transaksi.laporan', compact('transaksi'));
        return $pdf->stream();
    }

    public function laporanExcel(Request $request)
    {
        return Excel::download(new TransaksiExport, 'Transaksi.xlsx');
    }
}
