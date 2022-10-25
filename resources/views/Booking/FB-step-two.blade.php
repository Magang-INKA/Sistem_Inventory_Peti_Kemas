@extends('layouts.MasterView')
@section('menu_booking', 'active')
@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Create Booking</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('booking.index') }}">Booking</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <i class="icon-copy dw dw-add-file-1 fa-3x" aria-hidden="true"></i>
            </div>
        </div>
    </div>
    <div class="pd-20 card-box mb-30">
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('booking.create.step.two.post') }}" id="myForm">
            <div class="clearfix">
                <h4 class="text-blue h4">Booking Step - 2</h4>
                <h5 class="text-white">Barang</h5>
                <br>
            </div>

            @csrf
            {{-- <div class="form-group row" hidden>
                <label for="id_booking" class="col-sm-12 col-md-2 col-form-label text-white">ID Booking</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="id_booking" id="id_booking" aria-describedby="id_booking"
                        placeholder="" value="{{ $booking->id }}">
                </div>
            </div> --}}
            <div class="form-group row">
                <label for="nama_barang" class="col-sm-12 col-md-2 col-form-label text-white">Nama Barang</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="nama_barang" id="nama_barang" aria-describedby="nama_barang"
                        placeholder="">
                </div>
            </div>
            <div class="form-group row">
                <label for="jumlah_barang" class="col-sm-12 col-md-2 col-form-label text-white">Jumlah Barang</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="number" name="jumlah_barang" id="jumlah_barang" aria-describedby="jumlah_barang"
                        placeholder="">
                </div>
            </div>
            {{-- <div class="form-group row">
                <label for="nama_barang" class="col-sm-12 col-md-2 col-form-label text-white">Berat</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="nama_barang" name="nama_barang" id="nama_barang" aria-describedby="nama_barang"
                        placeholder="">
                </div>
            </div> --}}
            <div class="form-group row">
                <label for="requirement" class="col-sm-12 col-md-2 col-form-label text-white">Requirement</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text-area" name="requirement" id="requirement" aria-describedby="requirement"
                        placeholder="">
                </div>
            </div>
            {{-- <div class="form-group row" hidden>
                <label for="id_container" class="col-sm-12 col-md-2 col-form-label text-white">ID Container</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="id_container" id="id_container" aria-describedby="id_container"
                        placeholder="" value="{{ $booking->id_container }}">
                </div>
            </div> --}}


            <div class="form-group row">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Next</button>
                    {{-- <button type="reset" class="btn btn-danger">Reset</button> --}}
                    {{-- <div class="pull-right">
                    <a href="{{route('kapal.index')}}" type="button" class="btn" data-bgcolor="#3b5998" data-color="#ffffff">
                        <i class="icon-copy fa fa-arrow-left" aria-hidden="true"></i>
                        Kembali
                    </a>
                </div> --}}
                </div>
            </div>
        </form>
    </div>
@endsection
