@extends('layouts.MasterView')
@section('menu_kapal', 'active')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Show Detail Kapal</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('transaksi.index') }}">Kapal</a></li>
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
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="product-detail-desc pd-20 card-box height-100-p">
                    <form>
                        <div class="form-group row" style="padding-left: 20px">
                            <label for="nama" class="col-sm-10 col-md-4 col-form-label text-white">Nama Kapal</label>
                            <div class="col-md-7 col-sm-12">
                                <input class="form-control" type="text" name="nama" id="nama"
                                value="{{ $kapal->nama_kapal }}" aria-describedby="nama" placeholder="Disabled input" disabled="">
                            </div>
                        </div>
                        <div class="form-group row" style="padding-left: 20px">
                            <label for="id_keberangkatan" class="col-sm-10 col-md-4 col-form-label text-white">Keberangkatan</label>
                            <div class="col-md-7 col-sm-12">
                                <input class="form-control" type="text" name="id_keberangkatan" id="id_keberangkatan"
                                value="{{ $kapal->pelabuhan->nama_pelabuhan }}" aria-describedby="id_keberangkatan" placeholder="Disabled input" disabled="">
                            </div>
                        </div>
                        <div class="form-group row" style="padding-left: 20px">
                            <label for="id_tujuan" class="col-sm-10 col-md-4 col-form-label text-white">Tujuan</label>
                            <div class="col-md-7 col-sm-12">
                                <input class="form-control" type="text" name="id_tujuan" id="id_tujuan"
                                value="{{ $kapal->tujuan->nama_pelabuhan }}" aria-describedby="id_tujuan" placeholder="Disabled input" disabled="">
                            </div>
                        </div>
                        <div class="form-group row" style="padding-left: 20px">
                            <label for="jadwal" class="col-sm-10 col-md-4 col-form-label text-white">Jadwal</label>
                            <div class="col-md-7 col-sm-12">
                                <input class="form-control" type="date" name="jadwal" id="jadwal"
                                value="{{ $kapal->jadwal }}" aria-describedby="jadwal" placeholder="Disabled input" disabled="">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>
    <br>
            <div class="text-center">
                <a href="{{route('kapal.index')}}" type="button" class="btn btn-lg btn-block" data-bgcolor="rgb(40 94 138)" data-color="#ffffff">
                    <i class="icon-copy fa fa-arrow-left" aria-hidden="true"></i>
                    Kembali
                </a>
            </div>
</div>
@endsection
