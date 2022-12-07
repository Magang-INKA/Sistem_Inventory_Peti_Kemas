<?php

namespace App\Http\Controllers;

use App\Exports\TransaksiExport;
use App\Models\Booking;
use App\Models\JadwalKapal;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            $transaksi = Transaksi::where('id', 'like', "%" . $request->search . "%")
            ->orwhere('nama', 'like', "%" . $request->search . "%")
            ->orwhere('alamat', 'like', "%" . $request->search . "%")
            ->orwhere('telp', 'like', "%" . $request->search . "%")
            ->paginate();
            return view('Transaksi.index', compact('transaksi'))->with('i', (request()->input('page', 1) - 1) * 5);
        } else { // Pemilihan jika tidak melakukan pencarian
            //fungsi eloquent menampilkan data menggunakan pagination
            $transaksi = Transaksi::paginate(5);
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
        $num = Transaksi::orderBy('id','desc')->count();
        $dataCode = Transaksi::orderBy('id','desc')->first();
        if ($num == 0) {
            $code = 'SUP001';
        }
        else{
            $c = $dataCode->id;
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
            'id' => 'required',
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
        //menampilkan detail data dengan menemukan berdasarkan id transaksi untuk diedit

        $transaksi = Transaksi::find($id);
        // $var = (string)QrCode::format('png')->margin(0)->size(200)->generate($transaksi);
        return view('Transaksi.edit', compact('transaksi'));
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
            'harga' => 'required',
        ]);
        $t = Transaksi::find($id);
        $t->harga = $request->input('harga');
        $t->save();

        //fungsi eloquent untuk mengupdate data inputan kita
        $transaksi = DB::table('table_transaksi')
        ->select('table_transaksi.id',
        'table_transaksi.id_booking',
        'table_transaksi.harga',
        'booking.no_resi',
        'users.name',
        'users.email',
        'users.no_telp',
        'jenis_barang.jenis_barang',
        'master_barang.nama_barang',
        'master_barang.berat_barang',
        'jadwal_kapal.id',
        'jadwal_kapal.ETA',
        'jadwal_kapal.ETD',
        'p.nama_pelabuhan as asal',
        'p2.nama_pelabuhan as tujuan',
        'master_kapal.no_kapal',
        'master_kapal.nama_kapal',
        'master_container.no_container',
        'booking.nama_penerima',
        'booking.telp_penerima',
        'booking.alamat_penerima'
        )
        ->join('booking', 'booking.id', '=', 'table_transaksi.id_booking')
        ->join('users','users.id','=','booking.id_user')
        ->join('master_barang','master_barang.id','=','booking.id_barang')
        ->join('jenis_barang','jenis_barang.id','=','master_barang.jenis_barang')
        ->join('jadwal_kapal','jadwal_kapal.id','=','booking.id_jadwal')
        ->join('trip','trip.id','=','jadwal_kapal.id_trip')
        ->join('master_kapal','master_kapal.id','=','master_kapal.id')
        ->join('master_pelabuhan as p', 'jadwal_kapal.asal_pelabuhan_id', '=', 'p.kode_pelabuhan')
        ->join('master_pelabuhan as p2', 'jadwal_kapal.tujuan_pelabuhan_id', '=', 'p2.kode_pelabuhan')
        ->join('container','container.id_kapal','=','master_kapal.id')
        ->join('master_container','master_container.no_container','=','container.no_container')
        ->where('table_transaksi.id', '=', $id)->get();
        // return view('Transaksi.resi', compact('transaksi'));
        return view('Transaksi.index', compact('transaksi', 't'));

        // $tr = Transaksi::all();
        Alert::success('Success', 'Data Transaksi Berhasil Diupdate');
        // $pdf = PDF::loadview('Transaksi.resi', compact('transaksi'));
        // return $pdf->stream();
        // return view('Transaksi.index', compact('tr'));
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
        Transaksi::find($id)->delete();
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
