<?php

namespace App\Http\Controllers;

use App\Exports\ContainerExport;
use App\Models\Container;
use App\Models\Kapal;
use App\Models\MasterContainer;
use App\Models\MasterKapal;
use App\Models\Pelabuhan;
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
        $search = $request->search;
        if($request->has('search')){ // Pemilihan jika ingin melakukan pencarian
            $container = Container::where('no_container', 'like', "%" . $request->search . "%")
            ->orWhereHas('kapal', function($query) use($search) {
                return $query->where('nama_kapal', 'like', "%" . $search . "%");
            })
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
        $kapal = MasterKapal::all();
        $pelabuhan = Pelabuhan::all();
        $container = MasterContainer::all();
        return view('Container.create', compact('kapal', 'pelabuhan', 'container'));
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
            'no_container' => 'required',
            'id_kapal' => 'required',
            ]);

            //fungsi eloquent untuk menambah data
            $container = new Container;
            $container->no_container = $request->get('no_container');
            $container->id_kapal = $request->get('id_kapal');
            $container->save();

            //jika data berhasil ditambahkan, akan kembali ke halaman utama
            Alert::success('Success', 'Data Container Berhasil Ditambahkan');
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
        $kapal = Kapal::all();
        $pelabuhan = Pelabuhan::all();
        return view('Container.show', compact('container', 'kapal', 'pelabuhan'));
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
        $masterContainer = MasterContainer::all();
        $kapal = MasterKapal::all();
        $pelabuhan = Pelabuhan::all();
        return view('Container.edit', compact('container', 'kapal', 'pelabuhan', 'masterContainer'));
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
            'no_container' => 'required',
            'id_kapal' => 'required',
        ]);

        //fungsi eloquent untuk mengupdate data inputan kita
        Container::find($id)->update($request->all());

        //jika data berhasil diupdate, akan kembali ke halaman utama
        Alert::success('Success', 'Data Container Berhasil Diupdate');
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
        return Excel::download(new ContainerExport, 'Container.xlsx');
    }
}
