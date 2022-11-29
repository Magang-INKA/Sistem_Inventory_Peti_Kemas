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
use Carbon\Carbon;
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

        $user = User::all();
        $jb = JenisBarang::all();
        return view('booking.create',compact('user','containers','jb'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        //dd($request);
        try {
            // dd($request);
            $this->validate($request, [
                'jenis_barang' => 'required',
                'nama_barang' => 'required|string',
                'berat_barang' => 'required|integer',
            ]);
            $barang = DB::table('master_barang')->orderByDesc('id')->pluck('id')->first();
            $id=(int)$barang+1;

            $huruf = 'BKG';
            Barang::create([
                'jenis_barang' => $request->input('jenis_barang'),
                'nama_barang' =>  $request->input('nama_barang'),
                'berat_barang' => $request->input('berat_barang'),
            ]);

            $num = Booking::orderBy('no_resi','desc')->count();
            $dataCode = Booking::orderBy('no_resi','desc')->first();
            if ($num == 0) {
                $resi = 'BKG001';
            }
            else{
                $c = $dataCode->no_resi;
                $cod = (int) substr($c, 3);
                $cod++;
                $resi = $huruf . sprintf("%03s", $cod);
            }

            $date = Carbon::now()->toDateString();
            $q = new Booking();
            $q->no_resi = $resi;
            $q->id_user = '1';
            $q->id_jadwal = $request->input('id_jadwal');
            // $q->jenis_container = $request->input('jenis_container');
            // $q->id_container = '1';
            $q->id_barang = $id;
            $q->date = $date;
            $q->nama_penerima = $request->input('nama_penerima');
            $q->telp_penerima = $request->input('telp_penerima');
            $q->alamat_penerima = $request->input('alamat_penerima');;
            $q->status = 'belum';
            $q->save();

            Alert::success('Success', 'Data Booking Berhasil Ditambahkan');
            return view('Booking.StatusBooking');
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }

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
        //form booking
        $booking = Booking::find($id);
        $fjadwal = JadwalKapal::select('jadwal_kapal.id','jadwal_kapal.id_trip','trip.nama_trip', 'jadwal_kapal.ETA','jadwal_kapal.ETD','master_kapal.nama_kapal')
                            ->join('trip', 'trip.id', '=', 'jadwal_kapal.id_trip')
                            ->join('master_kapal', 'master_kapal.id', '=', 'trip.id_kapal')
                            ->Where('jadwal_kapal.id',$id)
                            ->get();

        foreach ($booking as $key => $book) {
            $idbarang = $booking->id_barang;
            $idjadwal = $booking->id_jadwal;
        }

        $barang = Barang::find($idbarang);

        $jadwal = DB::table('master_kapal')->join('trip', 'master_kapal.id', '=', 'trip.id_kapal')
        ->join('jadwal_kapal', 'trip.id', '=', 'jadwal_kapal.id_trip')
        ->join('booking', 'jadwal_kapal.id', '=', 'booking.id_jadwal')
        ->join('master_pelabuhan as p', 'jadwal_kapal.asal_pelabuhan_id', '=', 'p.kode_pelabuhan')
        ->join('master_pelabuhan as p2', 'jadwal_kapal.tujuan_pelabuhan_id', '=', 'p2.kode_pelabuhan')
        ->select('booking.id_jadwal', 'p.nama_pelabuhan as asal', 'p2.nama_pelabuhan as tujuan', 'jadwal_kapal.ETA', 'jadwal_kapal.ETD', 'master_kapal.nama_kapal')
        ->where('booking.id_jadwal', '=', $idjadwal)
        ->where('booking.id', '=', $id)->get();

        $jadwal_decode=print_r($jadwal, true);


        //modal tabel jadwal
        $tjadwal = JadwalKapal::join('trip', 'trip.id', '=', 'jadwal_kapal.id_trip')// joining the contacts table , where user_id and contact_user_id are same
            ->join('master_kapal', 'master_kapal.id', '=', 'trip.id_kapal')
            ->join('master_pelabuhan','master_pelabuhan.kode_pelabuhan','=','jadwal_kapal.asal_pelabuhan_id')
            ->join('master_pelabuhan as p','p.kode_pelabuhan','=','jadwal_kapal.tujuan_pelabuhan_id')
            ->join('container','container.id_kapal','=','master_kapal.id')
            ->join('master_container','master_container.no_container','=','container.no_container')
            ->select('jadwal_kapal.*','jadwal_kapal.id_trip','master_kapal.nama_kapal', 'jadwal_kapal.ETA','jadwal_kapal.ETD','master_kapal.nama_kapal','container.no_container','master_container.kapasitas')
            ->get();

        $jb = JenisBarang::all();

        return view('booking.edit', compact('booking','tjadwal','fjadwal','barang', 'jadwal', 'jadwal_decode','jb'));
        // return $jadwal;
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
        dd($request);
        try {
            // dd($request);
            $this->validate($request, [
                'id_user' => 'required',
                'id_jadwal' => 'required|string',
                'id_container' => 'required',
                'nama_penerima' => 'required',
                'telp_penerima' => 'required',
                'alamat_penerima' => 'required',
            ]);
            $barang = DB::table('master_barang')->orderByDesc('id')->pluck('id')->first();
            $id=(int)$barang+1;

            $huruf = 'BKG';
            Barang::create([
                'jenis_barang' => $request->input('jenis_barang'),
                'nama_barang' =>  $request->input('nama_barang'),
                'berat_barang' => $request->input('berat_barang'),
            ]);

            $num = Booking::orderBy('no_resi','desc')->count();
            $dataCode = Booking::orderBy('no_resi','desc')->first();
            if ($num == 0) {
                $resi = 'BKG001';
            }
            else{
                $c = $dataCode->no_resi;
                $cod = (int) substr($c, 3);
                $cod++;
                $resi = $huruf . sprintf("%03s", $cod);
            }

            $date = Carbon::now()->toDateString();
            $q = new Booking();
            $q->no_resi = $resi;
            $q->id_user = '1';
            $q->id_jadwal = $request->input('id_jadwal');
            // $q->jenis_container = $request->input('jenis_container');
            $q->id_container = '1';
            $q->id_barang = $id;
            $q->date = $date;
            $q->nama_penerima = $request->input('nama_penerima');
            $q->telp_penerima = $request->input('telp_penerima');
            $q->alamat_penerima = $request->input('alamat_penerima');;
            $q->status = 'belum';
            $q->save();

            Alert::success('Success', 'Data Booking Berhasil Ditambahkan');
            return view('Booking.StatusBooking');
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
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
            $pelabuhan2=JadwalKapal::select('id','jadwal_kapal.asal_pelabuhan_id','master_pelabuhan.nama_pelabuhan')
                    ->where('master_pelabuhan.nama_pelabuhan','LIKE',"%$search%")
                    ->join('master_pelabuhan', 'master_pelabuhan.kode_pelabuhan', '=', 'jadwal_kapal.asal_pelabuhan_id')
                    ->get();
        } else {
            $pelabuhan2 = JadwalKapal::where('asal_pelabuhan_id', $asalID)
                            ->orWhere('asal_pelabuhan_id',$tujuanID)
                            ->limit(10)
                            ->join('master_pelabuhan', 'master_pelabuhan.kode_pelabuhan', '=', 'jadwal_kapal.tujuan_pelabuhan_id')
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
            $pelabuhan2=JadwalKapal::select('id','jadwal_kapal.asal_pelabuhan_id','master_pelabuhan.nama_pelabuhan')
                    ->where('master_pelabuhan.nama_pelabuhan','LIKE',"%$search%")
                    ->join('master_pelabuhan', 'master_pelabuhan.kode_pelabuhan', '=', 'jadwal_kapal.asal_pelabuhan_id')
                    ->get();
        } else {
            $pelabuhan2 = JadwalKapal::select('jadwal_kapal.id','jadwal_kapal.id_trip','trip.nama_trip', 'jadwal_kapal.ETA','jadwal_kapal.ETD','master_kapal.nama_kapal')
                            ->join('trip', 'trip.id', '=', 'jadwal_kapal.id_trip')
                            ->join('master_kapal', 'master_kapal.id', '=', 'trip.id_kapal')
                            ->where('jadwal_kapal.asal_pelabuhan_id', $asalID)
                            ->Where('jadwal_kapal.tujuan_pelabuhan_id',$tujuanID)
                            ->limit(10)
                            ->get();
        }
        return response()->json($pelabuhan2);
    }
}
