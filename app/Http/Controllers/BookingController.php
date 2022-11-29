<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Booking;
use App\Models\Container;
use App\Models\JadwalKapal;
use App\Models\JenisBarang;
use App\Models\Kapal;
use App\Models\Pelabuhan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;
use Whoops\Run;

class BookingController extends Controller
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
        // abort(403, 'Anda tidak memiliki cukup hak akses');
        elseif(Gate::allows('manage-booking')) return $next($request);
        });
    }

    public function index()
    {

        if(Auth::user()->role == 'Administrator') {
            $booking = Booking::all();
            return view('Booking.index', compact('booking'));
        }
        elseif(Auth::user()->role == 'Client') {
            $book = Booking::where('id_user', Auth::user()->id)->get();
            // $book = Booking::all();
            // return $book;
            return view('Booking.StatusBooking', compact('book'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if(Auth::user()->role == 'Client') {
        //     Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
        //     return redirect()->to('/booking');
        // }
        $booking = Booking::with('container')->first();
        $containers = Container::all();
        // $pelabuhan = Pelabuhan::all();
        // $kapal = Kapal::all();
        $user = User::all();

        // $transaksi = Transaksi::all();
        // return view('Booking.FormBooking', compact('booking', 'containers', 'pelabuhan', 'kapal', 'user'));
        //$jb = JenisBarang::all();

        //return view('booking.create',compact('user','jb'));
        //return view('booking.create',compact('user'));
        return view('booking.FormBooking',compact('user','containers'));
        //return view('Booking.FB-step-one', compact('booking', 'user', 'containers'));
    }
    public function create2()
    {
        // if(Auth::user()->role == 'Client') {
        //     Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
        //     return redirect()->to('/booking');
        // }
        $barang = Barang::with('booking')->first();
        $booking = Booking::all();
        // $containers = Container::all();
        // $transaksi = Transaksi::all();
        return view('Booking.FB-step-two', compact('barang',  'booking'));
    }

    // public function createStepOne()
    // {
    //     // if(Auth::user()->role == 'Client') {
    //     //     Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
    //     //     return redirect()->to('/booking');
    //     // }
    //     $booking = Booking::with('container')->first();
    //     $containers = Container::all();
    //     // $pelabuhan = Pelabuhan::all();
    //     // $kapal = Kapal::all();
    //     $user = User::all();

    //     // $transaksi = Transaksi::all();
    //     // return view('Booking.FormBooking', compact('booking', 'containers', 'pelabuhan', 'kapal', 'user'));
    //     return view('Booking.FB-step-one', compact('booking', 'user', 'containers'));
    // }

    public function postCreateStepOne(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'id_user' => 'required',
            'id_container' => 'required',
            'id_kapal' => 'required',
            'id_pelabuhan' => 'required',
            'date' => 'required',
            'status' => 'required',
        ]);
        if(empty($request->session()->get('booking'))){
            $booking = new Booking();
            $booking->fill($validatedData);
            $request->session()->put('booking', $booking);
        }else{
            $booking = $request->session()->get('booking');
            $booking->fill($validatedData);
            $request->session()->put('booking', $booking);
        }

        return redirect()->route('booking.create.step.two');
    }

    // public function createStepTwo()
    // {
    //     $booking = Booking::with('container')->first();
    //     $containers = Container::all();
    //     // $pelabuhan = Pelabuhan::all();
    //     // $kapal = Kapal::all();
    //     $user = User::all();

    //     // $transaksi = Transaksi::all();
    //     // return view('Booking.FormBooking', compact('booking', 'containers', 'pelabuhan', 'kapal', 'user'));
    //     return view('Booking.FB-step-one', compact('booking', 'user', 'containers'));
    // }

    public function postCreateStepTwo(Request $request)
    {

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
            $request->session()->put('barang', $barang);
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
        dd($request);
        // $request->validate([
        //     'id_user' => 'required',
        //     'id_container' => 'required',
        //     'id_kapal' => 'required',
        //     'id_pelabuhan' => 'required',
        //     'date' => 'required',
        //     'status' => 'required',
        //     // 'status_booking' => 'required',
        //     // 'nama_barang' => 'required',
        //     // 'jumlah_barang' => 'required',
        //     // 'requirement' => 'required',
        // ]);
        // $booking = new Booking;
        // // $booking = Booking::where('id_user', auth()->user()->id);
        // $booking->id_user = auth()->user()->id;
        // $booking->id_container = $request->get('id_container');
        // $booking->id_kapal = $request->get('id_kapal');
        // $booking->id_pelabuhan = $request->get('id_pelabuhan');
        // $booking->date = $request->get('date');
        // // $booking->status = $request->get('status');
        // $booking->save();

        // $barang = new Barang;
        // $barang->id_booking = $booking->id;
        // $barang->nama_barang = $request->input('nama_barang');
        // $barang->jumlah_barang = $request->input('jumlah_barang');
        // $barang->requirement = $request->input('requirement');
        // $barang->save();
        // $barang->booking()->create([
        //     'nama_barang' => $request->input('nama_barang'),
        //     'jumlah_barang' => $request->input('jumlah_barang'),
        //     'requirement' => $request->input('requirement'),
        // ]);
        //fungsi eloquent untuk menambah data
        // Booking::create($request->all());

        //jika data berhasil ditambahkan, akan kembali ke halaman utama
        Alert::success('Success', 'Data Booking Berhasil Ditambahkan');
        return view('Booking.StatusBooking');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('Booking/show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('Booking/edit');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
            $pelabuhan2=JadwalKapal::select('id','jadwalkapal.asal_pelabuhan_id','pelabuhan.nama_pelabuhan')
                    ->where('pelabuhan.nama_pelabuhan','LIKE',"%$search%")
                    ->join('pelabuhan', 'pelabuhan.kode_pelabuhan', '=', 'jadwalkapal.asal_pelabuhan_id')
                    ->get();
        } else {
            $pelabuhan2 = JadwalKapal::where('asal_pelabuhan_id', $asalID)
                            ->orWhere('asal_pelabuhan_id',$tujuanID)
                            ->limit(10)
                            ->join('pelabuhan', 'pelabuhan.kode_pelabuhan', '=', 'jadwalkapal.tujuan_pelabuhan_id')
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
            $pelabuhan2=JadwalKapal::select('id','jadwalkapal.asal_pelabuhan_id','pelabuhan.nama_pelabuhan')
                    ->where('pelabuhan.nama_pelabuhan','LIKE',"%$search%")
                    ->join('pelabuhan', 'pelabuhan.kode_pelabuhan', '=', 'jadwalkapal.asal_pelabuhan_id')
                    ->get();
        } else {
            $pelabuhan2 = JadwalKapal::select('jadwalkapal.id','jadwalkapal.id_trip','trip.nama_trip', 'jadwalkapal.ETA','jadwalkapal.ETD','kapal.nama_kapal')
                            ->join('trip', 'trip.id', '=', 'jadwalkapal.id_trip')
                            ->join('kapal', 'kapal.id', '=', 'trip.id_kapal')
                            ->where('jadwalkapal.asal_pelabuhan_id', $asalID)
                            ->Where('jadwalkapal.tujuan_pelabuhan_id',$tujuanID)
                            ->limit(10)
                            ->get();
        }
        return response()->json($pelabuhan2);
    }
}
