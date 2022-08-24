<?php

namespace App\Http\Controllers;

use App\Exports\ContainerExport;
use App\Models\Container;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;

class ContainerController extends Controller
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
            $container = Container::where('kode_container', 'like', "%" . $request->search . "%")
            ->orwhere('nama_container', 'like', "%" . $request->search . "%")
            ->orwhere('keterangan', 'like', "%" . $request->search . "%")
            ->paginate();
            return view('Container.index', compact('container'))->with('i', (request()->input('page', 1) - 1) * 5);
        } else { // Pemilihan jika tidak melakukan pencarian
            //fungsi eloquent menampilkan data menggunakan pagination
            $container = Container::paginate(10); // MenPagination menampilkan 5 data
            return view('Container.index', compact('container'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Container.create');
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
            'kode_container' => 'required',
            'nama_container' => 'required',
            ]);

            //fungsi eloquent untuk menambah data
            Container::create($request->all());

            //jika data berhasil ditambahkan, akan kembali ke halaman utama
            Alert::success('Success', 'Data Container Barang Berhasil Ditambahkan');
            return redirect()->route('container.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //menampilkan detail data dengan menemukan berdasarkan id container
        $container = Container::find($id);
        return view('Container.show', compact('container'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //menampilkan detail data dengan menemukan berdasarkan id container untuk diedit
        $container = Container::find($id);
        return view('Container.edit', compact('container'));
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
            'kode_container' => 'required',
            'nama_container' => 'required',
            'keterangan' => 'required',
            ]);

        //fungsi eloquent untuk mengupdate data inputan kita
            Container::find($id)->update($request->all());

        //jika data berhasil diupdate, akan kembali ke halaman utama
            Alert::success('Success', 'Data Container Barang Berhasil Diupdate');
            return redirect()->route('container.index');
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
        Container::find($id)->delete();
        Alert::success('Success', 'Data container berhasil dihapus');
        return redirect()->route('container.index');
    }

    public function laporan()
    {
        $container = Container::all();
        $pdf = PDF::loadview('Container.laporan', compact('container'));
        return $pdf->stream();
    }

    public function laporanExcel(Request $request)
    {
        return Excel::download(new ContainerExport, 'containerBarang.xlsx');
    }
}
