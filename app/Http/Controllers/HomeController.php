<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Container;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $container       = Container::get();
        $barang         = Barang::get();
        $transaksi       = Transaksi::get();
        $user           = User::get();


        return view('coba', compact('container', 'barang', 'transaksi', 'user'));
    }
}
