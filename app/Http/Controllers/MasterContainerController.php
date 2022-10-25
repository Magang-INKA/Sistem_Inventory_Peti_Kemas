<?php

namespace App\Http\Controllers;

use App\Exports\MasterContainerExport;
use App\Models\MasterContainer;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;

class MasterContainerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware(function($request, $next){
        // if(Gate::allows('manage-MasterData')) return $next($request);
        // abort(403, 'Anda tidak memiliki cukup hak akses');
        // });
    }

    public function index(Request $request)
    {
        if($request->has('search')){ // Pemilihan jika ingin melakukan pencarian
            $masterContainer = MasterContainer::where('no_container', 'like', "%" . $request->search . "%")
            ->orwhere('jenis', 'like', "%" . $request->search . "%")
            ->orwhere('ukuran', 'like', "%" . $request->search . "%")
            ->paginate();
            return view('Container.master', compact('masterContainer'))->with('i', (request()->input('page', 1) - 1) * 5);
        } else { // Pemilihan jika tidak melakukan pencarian
            //fungsi eloquent menampilkan data menggunakan pagination
            $masterContainer = MasterContainer::paginate(10); // MenPagination menampilkan 5 data
            return view('Container.master', compact('masterContainer'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Container.createMaster');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_container' => 'required',
            'jenis' => 'required',
            'ukuran' => 'required',
            ]);

            //fungsi eloquent untuk menambah data
            $masterContainer = new MasterContainer();
            $masterContainer->no_container = $request->get('no_container');
            $masterContainer->jenis = $request->get('jenis');
            $masterContainer->ukuran = $request->get('ukuran');
            $masterContainer->save();

            //jika data berhasil ditambahkan, akan kembali ke halaman utama
            Alert::success('Success', 'Data Container Berhasil Ditambahkan');
            return redirect()->route('masterContainer.index');
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
        $masterContainer = MasterContainer::find($id);
        return view('Container.editMaster', compact('masterContainer'));
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
        $request->validate([
            'no_container' => 'required',
            'jenis' => 'required',
            'ukuran' => 'required',
            ]);

            //fungsi eloquent untuk menambah data
            MasterContainer::find($id)->update($request->all());

            //jika data berhasil ditambahkan, akan kembali ke halaman utama
            Alert::success('Success', 'Master Data Container Berhasil Ditambahkan');
            return redirect()->route('masterContainer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MasterContainer::find($id)->delete();
        Alert::success('Success', 'Master Data Container berhasil dihapus');
        return redirect()->route('masterContainer.index');
    }

    public function laporan()
    {
        $masterContainer = MasterContainer::all();
        $pdf = PDF::loadview('Container.laporanMaster', compact('masterContainer'));
        return $pdf->stream();
    }

    public function laporanExcel(Request $request)
    {
        return Excel::download(new MasterContainerExport, 'masterContainer.xlsx');
    }
}
