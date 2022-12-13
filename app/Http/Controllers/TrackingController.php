<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\DropPoint;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;

class TrackingController extends Controller
{
    public function tracking(Request $request)
    {
        $search = $request->search;
        if($request->has('search')){
            $tracking = DB::table('drop_point')
            ->select('drop_point.keterangan',
            'drop_point.created_at',
            'drop_point.pelabuhan',
            'master_pelabuhan.nama_pelabuhan'
            )
            ->join('master_pelabuhan', 'drop_point.pelabuhan', '=', 'master_pelabuhan.kode_pelabuhan')
            ->join('transaksi', 'drop_point.id_transaksi', '=', 'transaksi.id')
            ->join('booking', 'transaksi.id_booking', '=', 'booking.id')
            ->where('booking.no_resi', '=', $search)
            ->orderBy('drop_point.created_at', 'desc')->get();
            if (!$tracking->isEmpty()) {
                Session::flash('success', 'Tracking berhasil!');
                // Session::flash('alert-class', 'alert-success');
                // $request->session()->flash('message', 'Tracking berhasil!');
                // $request->session()->flash('alert-class', 'alert-success');
                return view('Dashboard.tracking',compact('tracking'));
                // return $tracking;
            } else {
                Session::flash('error', 'Data tidak ditemukan!');
                // Session::flash('alert-class', 'alert-danger');
                // $request->session()->flash('message', 'Data tidak ditemukan!');
                // $request->session()->flash('alert-class', 'alert-danger');
                return view('Dashboard.tracking',compact('tracking'));
                // return $tracking;
            }
        }
        // else {
        //     $tracking = DropPoint::with('pelabuhan');
        //     // return $tracking;
        //     return view('Dashboard.tracking',compact('tracking'));
        // }
        $tracking = DropPoint::with('pelabuhan');
        Session::flush();
        // return $tracking;
        return view('Dashboard.tracking',compact('tracking'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        if($request->has('search')){
            $tracking = DB::table('drop_point')
            ->select('drop_point.keterangan',
            'drop_point.created_at',
            'drop_point.pelabuhan'
            )
            ->join('transaksi', 'drop_point.id_transaksi', '=', 'transaksi.id')
            ->join('booking', 'transaksi.id_booking', '=', 'booking.id')
            ->where('booking.no_resi', '=', $search)
            ->orderBy('drop_point.created_at', 'desc')->get();
            if (!$tracking->isEmpty()) {
                Session::flash('success', 'Tracking berhasil!');
                // Session::flash('alert-class', 'alert-success');
                // $request->session()->flash('message', 'Tracking berhasil!');
                // $request->session()->flash('alert-class', 'alert-success');
                return view('Dashboard.tracking',compact('tracking'));
                // return $tracking;
            } else {
                Session::flash('error', 'Data tidak ditemukan!');
                // Session::flash('alert-class', 'alert-danger');
                // $request->session()->flash('message', 'Data tidak ditemukan!');
                // $request->session()->flash('alert-class', 'alert-danger');
                return view('Dashboard.tracking',compact('tracking'));
                // return $tracking;
            }
        } else {
            $tracking = DropPoint::with('pelabuhan');
            // return $tracking;
            return view('Dashboard.tracking',compact('tracking'));
        }
    }
}
