@extends('layouts.MasterView')
@section('menu_booking', 'active')
@section('content')
{{-- <div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Menu Detail Booking</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('booking.index') }}">Booking</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Show</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-6 col-sm-12 text-right">
            <i class="icon-copy fa fa-info-circle fa-3x" aria-hidden="true"></i>
        </div>
    </div>
</div> --}}
{{-- <div class="product-wrap">
    <div class="product-detail-wrap mb-30"> --}}
        {{-- <div class="pd-20 card-box height-100-p text-center" >
            <img height="300" @if($barang->gambar) src="{{ asset('storage/'.$barang->gambar) }}" @endif />
        </div>
        <br> --}}
        {{-- <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12"> --}}
            {{-- <div class="pd-20 card-box height-100-p text-center" >
                    <img height="300" @if($barang->gambar) src="{{ asset('storage/'.$barang->gambar) }}" @endif />
            </div> --}}
                {{-- <div class="product-detail-desc pd-20 card-box height-100-p">
                    <form>
                        <div class="form-group row" style="padding-left: 40px">
                            <label for="kode_barang" class="col-sm-10 col-md-4 col-form-label text-white">Nama Pengirim</label>
                            <div class="col-md-7 col-sm-12">
                                <input class="form-control" type="text" name="kode_barang" id="kode_barang" value="{{ $barang->kode_barang }}" aria-describedby="kode_barang" placeholder="Disabled input" disabled="">
                            </div>
                        </div>
                        <div class="form-group row" style="padding-left: 40px">
                            <label for="id_container" class="col-sm-10 col-md-4 col-form-label text-white">No.Telp Pengirim</label>
                            <div class="col-md-7 col-sm-12">
                                <input class="form-control" type="text" name="id_container" id="id_container" value="{{ $barang->container->nama_container }}" aria-describedby="id_container" placeholder="Disabled input" disabled="">
                            </div>
                        </div>
                        <div class="form-group row" style="padding-left: 40px">
                            <label for="nama_barang" class="col-sm-10 col-md-4 col-form-label text-white">Email Pengirim</label>
                            <div class="col-md-7 col-sm-12">
                                <input class="form-control" type="text" name="nama_barang" id="nama_barang" value="{{ $barang->nama_barang }}" aria-describedby="nama_barang" placeholder="Disabled input" disabled="">
                            </div>
                        </div>
                        <div class="form-group row" style="padding-left: 40px">
                            <label for="merk_barang" class="col-sm-10 col-md-4 col-form-label text-white">Status Booking</label>
                            <div class="col-md-7 col-sm-12">
                                <input class="form-control" type="text" name="merk_barang" id="merk_barang" value="{{ $barang->merk_barang }}" aria-describedby="merk_barang" placeholder="Disabled input" disabled="">
                            </div>
                        </div>
                        <div class="form-group row" style="padding-left: 40px">
                            <label for="bahan" class="col-sm-10 col-md-4 col-form-label text-white">Container</label>
                            <div class="col-md-7 col-sm-12">
                                <input class="form-control" type="text" name="bahan" id="bahan" value="{{ $barang->bahan }}" aria-describedby="bahan" placeholder="Disabled input" disabled="">
                            </div>
                        </div>
                        <div class="form-group row" style="padding-left: 40px">
                            <label for="jumlah_barang" class="col-sm-10 col-md-4 col-form-label text-white">Jadwal</label>
                            <div class="col-md-7 col-sm-12">
                                <input class="form-control" type="number" name="jumlah_barang" id="jumlah_barang" value="{{ $barang->jumlah_barang }}" aria-describedby="jumlah_barang" placeholder="Disabled input" disabled="">
                            </div>
                        </div>
                        <div class="form-group row" style="padding-left: 40px">
                            <label for="harga" class="col-sm-10 col-md-4 col-form-label text-white">Nama Barang</label>
                            <div class="col-md-7 col-sm-12">
                                <input class="form-control" type="number" name="harga" id="harga" value="{{ $barang->harga }}" aria-describedby="harga" placeholder="Disabled input" disabled="">
                            </div>
                        </div>
                        <div class="form-group row" style="padding-left: 40px">
                            <label for="id_transaksi" class="col-sm-10 col-md-4 col-form-label text-white">Jumlah Barang</label>
                            <div class="col-md-7 col-sm-12">
                                <input class="form-control" type="text" name="id_transaksi" id="id_transaksi" value="{{ $barang->transaksi->nama }}" aria-describedby="id_transaksi" placeholder="Disabled input" disabled="">
                            </div>
                        </div>
                        <div class="form-group row" style="padding-left: 40px">
                            <label for="tgl_input" class="col-sm-10 col-md-4 col-form-label text-white">Berat Barang (Kg)</label>
                            <div class="col-md-7 col-sm-12">
                                <input class="form-control" type="date" name="tgl_input" id="tgl_input" value="{{ $barang->tgl_input }}" aria-describedby="tgl_input" placeholder="Disabled input" disabled="">
                            </div>
                        </div>
                        <div class="form-group row" style="padding-left: 40px">
                            <label for="tgl_input" class="col-sm-10 col-md-4 col-form-label text-white">Requirement</label>
                            <div class="col-md-7 col-sm-12">
                                <input class="form-control" type="date" name="tgl_input" id="tgl_input" value="{{ $barang->tgl_input }}" aria-describedby="tgl_input" placeholder="Disabled input" disabled="">
                            </div>
                        </div>
                        <div class="form-group row" style="padding-left: 40px">
                            <label for="id_transaksi" class="col-sm-10 col-md-4 col-form-label text-white">Nama Penerima</label>
                            <div class="col-md-7 col-sm-12">
                                <input class="form-control" type="text" name="id_transaksi" id="id_transaksi" value="{{ $barang->transaksi->nama }}" aria-describedby="id_transaksi" placeholder="Disabled input" disabled="">
                            </div>
                        </div>
                        <div class="form-group row" style="padding-left: 40px">
                            <label for="id_transaksi" class="col-sm-10 col-md-4 col-form-label text-white">Alamat Penerima</label>
                            <div class="col-md-7 col-sm-12">
                                <input class="form-control" type="text" name="id_transaksi" id="id_transaksi" value="{{ $barang->transaksi->nama }}" aria-describedby="id_transaksi" placeholder="Disabled input" disabled="">
                            </div>
                        </div>
                        <div class="form-group row" style="padding-left: 40px">
                            <label for="id_transaksi" class="col-sm-10 col-md-4 col-form-label text-white">No.Telp Penerima</label>
                            <div class="col-md-7 col-sm-12">
                                <input class="form-control" type="text" name="id_transaksi" id="id_transaksi" value="{{ $barang->transaksi->nama }}" aria-describedby="id_transaksi" placeholder="Disabled input" disabled="">
                            </div>
                        </div>
                        <div class="form-group row" style="padding-left: 40px">
                            <label for="id_transaksi" class="col-sm-10 col-md-4 col-form-label text-white">Email Penerima</label>
                            <div class="col-md-7 col-sm-12">
                                <input class="form-control" type="text" name="id_transaksi" id="id_transaksi" value="{{ $barang->transaksi->nama }}" aria-describedby="id_transaksi" placeholder="Disabled input" disabled="">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <br>
        <div class="text-center">
            <a href="{{route('barang.index')}}" type="button" class="btn btn-lg btn-block" data-bgcolor="rgb(40 94 138)" data-color="#ffffff">
                <i class="icon-copy fa fa-arrow-left" aria-hidden="true"></i>
                Kembali
            </a>
        </div>
    </div>
</div>
@endsection --}}
