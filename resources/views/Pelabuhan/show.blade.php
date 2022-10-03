@extends('layouts.MasterView')
@section('menu_pelabuhan', 'active')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Show Detail Pelabuhan</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('pelabuhan.index') }}">Barang</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Show</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-6 col-sm-12 text-right">
            <i class="icon-copy fa fa-info-circle fa-3x" aria-hidden="true"></i>
        </div>
    </div>
</div>
<div class="product-wrap">
    <div class="product-detail-wrap mb-30">
        <div class="pd-20 card-box height-100-p text-center" >
            <img height="300" @if($pelabuhan->gambar) src="{{ asset('storage/'.$pelabuhan->gambar) }}" @endif />
        </div>
        <br>
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="product-detail-desc pd-20 card-box height-100-p">
                    <form>
                        <div class="form-group row" style="padding-left: 40px">
                            <label for="id" class="col-sm-10 col-md-4 col-form-label text-white">ID Pelabuhan</label>
                            <div class="col-md-7 col-sm-12">
                                <input class="form-control" type="text" name="id" id="id" value="{{ $pelabuhan->id }}" aria-describedby="kode_barang" placeholder="Disabled input" disabled="">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="product-detail-desc pd-20 card-box height-100-p">
                    <form>
                        <div class="form-group row" style="padding-left: 40px">
                            <label for="nama_pelabuhan" class="col-sm-10 col-md-4 col-form-label text-white">Nama Pelabuhan</label>
                            <div class="col-md-7 col-sm-12">
                                <input class="form-control" type="text" name="nama_pelabuhan" id="nama_pelabuhan" value="{{ $pelabuhan->nama_pelabuhan }}" aria-describedby="kode_barang" placeholder="Disabled input" disabled="">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <br>
        <div class="text-center">
            <a href="{{route('pelabuhan.index')}}" type="button" class="btn btn-lg btn-block" data-bgcolor="rgb(40 94 138)" data-color="#ffffff">
                <i class="icon-copy fa fa-arrow-left" aria-hidden="true"></i>
                Kembali
            </a>
        </div>
    </div>
</div>
@endsection
