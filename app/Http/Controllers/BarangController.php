<?php

namespace App\Http\Controllers;

use App\Exports\BarangExport;
use App\Models\Barang;
use App\Models\Booking;
use App\Models\Container;
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
            ->orWhereHas('container', function($query) use($search) {
                return $query->where('nama_container', 'like', "%" . $search . "%");
            })
            ->paginate();
            return view('Barang.index', compact('barang'))->with('i', (request()->input('page', 1) - 1) * 5);
        } else { // Pemilihan jika tidak melakukan pencarian
            //fungsi eloquent menampilkan data menggunakan pagination
            $barang = Barang::with('container')->paginate(10); // Pagination menampilkan 5 data
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
        // if(Auth::user()->role == 'Operator') {
        //     Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
        //     return redirect()->to('/barang');
        // }

        // //melakukan validasi data
        // $request->validate([
        //     'nama_barang' => 'required',
        //     'jumlah_barang' => 'required',
        //     'berat' =>
        //     ]);

        //     $barang = new Barang;
        //     $barang->nama_barang = $request->get('nama_barang');
        //     $barang->jumlah_barang = $request->get('jumlah_barang');
        //     $barang->requirement = $request->get('requirement');
        //     $barang->save();

            // if ($request->file('gambar')) {
            //     $image_name = $request->file('gambar')->store('images', 'public');
            // }

            // $container = Container::find($request->get('id_container'));
            // $transaksi = Transaksi::find($request->get('id_transaksi'));

            // $barang = new Barang;
            // $barang->id_container = $request->get('id_container');
            // $barang->nama_barang = $request->get('nama_barang');
            // $barang->gambar = $image_name;
            // $barang->jumlah = $request->get('jumlah');
            // $barang->requirement = $request->get('requirement');
            // $barang->bahan = $request->get('bahan');
            // $barang->harga = $request->get('harga');
            // $barang->tgl_input = $request->get('tgl_input');

            //fungsi eloquent untuk menambah data dengan relasi belongsTo
            // $barang->container()->associate($container);
            // // $barang->transaksi()->associate($transaksi);
            // $barang->save();

            //jika data berhasil ditambahkan, akan kembali ke halaman utama
            Alert::success('Success', 'Data Barang Berhasil Ditambahkan');
            return redirect()->route('barang.index');


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
        if(Auth::user()->role == 'Operator') {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/barang');
        }

        $barang = Barang::with('container','transaksi')->find($id);
        $container = Container::all();
        $transaksi = Transaksi::all();
        return view('Barang.edit', compact('barang', 'container', 'transaksi'));
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
            'kode_barang'   => 'required',
            'nama_barang'   => 'required',
            'jumlah_barang' => 'required',
            'id_container'   => 'required',
            'id_transaksi'   => 'required',
            'merk_barang'   => 'required',
            'bahan'         => 'required',
            'harga'         => 'required',
            'tgl_input'     => 'required',
        ]);

        $barang = Barang::with('container', 'transaksi')->where('id', $id)->first();

        if ($request->file('gambar') == ''){
            $barang->kode_barang = $request->get('kode_barang');
            $barang->nama_barang = $request->get('nama_barang');
            $barang->jumlah_barang = $request->get('jumlah_barang');
            $barang->merk_barang = $request->get('merk_barang');
            $barang->bahan = $request->get('bahan');
            $barang->harga = $request->get('harga');
            $barang->tgl_input = $request->get('tgl_input');

            $container = Container::find($request->get('id_container'));
            $transaksi = Transaksi::find($request->get('id_transaksi'));
            //fungsi eloquent untuk menambah data dengan relasi belongsTo
            $barang->container()->associate($container);
            $barang->transaksi()->associate($transaksi);
            $barang->save();
        } else{
            if ($barang->gambar && file_exists(storage_path('app/public/' .$barang->gambar)))
            {
                \Storage::delete(['public/' . $barang->gambar]);
            }
            $image_name = $request->file('gambar')->store('images', 'public');
            $barang->gambar = $image_name;

            $barang->kode_barang = $request->get('kode_barang');
            $barang->nama_barang = $request->get('nama_barang');
            $barang->jumlah_barang = $request->get('jumlah_barang');
            $barang->merk_barang = $request->get('merk_barang');
            $barang->bahan = $request->get('bahan');
            $barang->harga = $request->get('harga');
            $barang->tgl_input = $request->get('tgl_input');

            $container = Container::find($request->get('id_container'));
            $transaksi = Transaksi::find($request->get('id_transaksi'));
            //fungsi eloquent untuk menambah data dengan relasi belongsTo
            $barang->container()->associate($container);
            $barang->transaksi()->associate($transaksi);
            $barang->save();
        }

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
