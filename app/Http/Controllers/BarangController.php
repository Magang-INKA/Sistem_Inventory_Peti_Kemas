<?php

namespace App\Http\Controllers;

use App\Exports\BarangExport;
use App\Models\Barang;
use App\Models\Booking;
use App\Models\Container;
use App\Models\JenisBarang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $search = $request->search;
        if($request->has('search')){ // Pemilihan jika ingin melakukan pencarian
            $barang = Barang::where('kode_barang', 'like', "%" . $search . "%")
            ->orwhere('nama_barang', 'like', "%" . $search . "%")
            ->orwhere('jumlah_barang', 'like', "%" . $search . "%")
            ->orWhereHas('jenis_barang', function($query) use($search) {
                return $query->where('jenis_barang', 'like', "%" . $search . "%");
            })
            ->paginate();
            return view('Barang.index', compact('barang'))->with('i', (request()->input('page', 1) - 1) * 5);
        } else { // Pemilihan jika tidak melakukan pencarian
            //fungsi eloquent menampilkan data menggunakan pagination
            $barang = Barang::with('JenisBarang')->paginate(10); // Pagination menampilkan 5 data
        }
        return view('Barang.index', compact('barang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if(Auth::user()->role == 'Operator') {
        //     Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
        //     return redirect()->to('/barang');
        // }
        $barang = Barang::with('booking')->first();
        $booking = Booking::all();
        // $containers = Container::all();
        // $transaksi = Transaksi::all();
        return view('Booking.FB-step-two', compact('barang',  'booking'));
    }

    public function postCreateStepTwo(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'nama_barang' => 'required',
            'jumlah_barang' => 'required',
            'requirement' => 'required',
            'id_container' => 'required',
            'id_booking' => 'required',
        ]);
        if(empty($request->session()->get('booking'))){
            $barang = new Barang();
            $barang->fill($validatedData);
            $request->session()->put('barang', $barang);
        }else{
            $barang = $request->session()->get('barang');
            $barang->fill($validatedData);
            $request->session()->put('barang', $booking);
        }

        return redirect()->route('booking.create.step.two');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->role == 'Operator') {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/barang');
        }

        $barang = Barang::with('container','transaksi')->find($id);
        return view('Barang.show', compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // if(Auth::user()->role == 'Operator') {
        //     Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
        //     return redirect()->to('/barang');
        // }

        $barang = Barang::find($id);
        $jb = JenisBarang::all();
        return view('Barang.edit', compact('barang', 'jb'));
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
        if(Auth::user()->role == 'Operator') {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/barang');
        }

        $request->validate([
            'jenis_barang'   => 'required',
            'nama_barang'   => 'required',
            'berat_barang' => 'required',
        ]);

        $barang = Barang::with('JenisBarang')->where('id', $id)->first();

        // $barang->jenis_barang = $request->get('jenis_barang');
        $barang->nama_barang = $request->get('nama_barang');
        $barang->berat_barang = $request->get('berat_barang');
        $JenisBarang = JenisBarang::find($request->get('jenis_barang'));

        //fungsi eloquent untuk menambah data dengan relasi belongsTo
        $barang->JenisBarang()->associate($JenisBarang);
        $barang->save();

        //jika data berhasil ditambahkan, akan kembali ke halaman utama
        Alert::success('Success', 'Data Barang Berhasil Diedit');
        return redirect()->route('barang.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->role == 'Operator') {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/barang');
        }

        Barang::find($id)->delete();
        Alert::success('Success', 'Data Barang berhasil dihapus');
        return redirect()->route('barang.index');
    }

    public function laporan()
    {
        $barang = Barang::all();
        $container = Container::all();
        $transaksi = Transaksi::all();
        $pdf = PDF::loadview('Barang.laporan', compact('barang', 'container', 'transaksi'));
        return $pdf->stream();
    }

    public function laporanExcel(Request $request)
    {
        return Excel::download(new BarangExport, 'Barang.xlsx');
    }
}
