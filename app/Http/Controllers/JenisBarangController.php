<?php

namespace App\Http\Controllers;

use App\Models\JenisBarang;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class JenisBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        if($request->has('search')){ // Pemilihan jika ingin melakukan pencarian
            $JenisBarang = JenisBarang::where('kode_barang', 'like', "%" . $search . "%")
            ->orwhere('nama_barang', 'like', "%" . $search . "%")
            ->orwhere('jumlah_barang', 'like', "%" . $search . "%")
            ->orWhereHas('jenis_barang', function($query) use($search) {
                return $query->where('jenis_barang', 'like', "%" . $search . "%");
            })
            ->paginate();
            return view('Barang.JenisBarang.index', compact('JenisBarang'))->with('i', (request()->input('page', 1) - 1) * 5);
        } else { // Pemilihan jika tidak melakukan pencarian
            //fungsi eloquent menampilkan data menggunakan pagination
            $JenisBarang = JenisBarang::all(); 
        }
        return view('Barang.JenisBarang.index', compact('JenisBarang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $JenisBarang = JenisBarang::all();
        return view('Barang.JenisBarang.create', compact('JenisBarang'));
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
            'jenis_barang' => 'required',
            'suhu' => 'required',
        ]);
        $JenisBarang = new JenisBarang;
        $JenisBarang->jenis_barang = $request->get('jenis_barang');
        $JenisBarang->suhu = $request->get('suhu');
        $JenisBarang->save();

        Alert::success('Success', 'Data Jenis Barang Berhasil Ditambahkan');
        return redirect()->route('JenisBarang.index');
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
        $JenisBarang = JenisBarang::find($id);
        return view('Barang.JenisBarang.edit', compact('JenisBarang'));
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
            'jenis_barang' => 'required',
            'suhu' => 'required',
        ]);
        $JenisBarang = JenisBarang::where('id', $id)->first();;
        $JenisBarang->jenis_barang = $request->get('jenis_barang');
        $JenisBarang->suhu = $request->get('suhu');
        $JenisBarang->save();

        Alert::success('Success', 'Data Jenis Barang Berhasil Diedit');
        return redirect()->route('JenisBarang.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        JenisBarang::find($id)->delete();
        Alert::success('Success', 'Data Jenis Barang berhasil dihapus');
        return redirect()->route('JenisBarang.index');
    }
}
