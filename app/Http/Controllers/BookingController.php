<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Booking;
use App\Models\Container;
use App\Models\Kapal;
use App\Models\Pelabuhan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;

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
        return view('Booking/index');
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
        return view('Booking.FormBooking', compact('booking', 'user', 'containers'));
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
}
