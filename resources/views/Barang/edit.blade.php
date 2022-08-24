@extends('layouts.MasterView')
@section('menu_barang', 'active')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Edit Barang</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('barang.index') }}">Barang</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-6 col-sm-12 text-right">
            <i class="icon-copy dw dw-add-file-1 fa-3x" aria-hidden="true"></i>
        </div>
    </div>
</div>
<!-- Default Basic Forms Start -->
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
	<form method="POST" action="{{ route('barang.update', $barang->id) }}" id="myForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')
		<div class="form-group row">
			<label for="kode_barang" class="col-sm-12 col-md-2 col-form-label text-white">Kode Barang</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="text" name="kode_barang" id="kode_barang" value="{{ $barang->kode_barang }}" aria-describedby="kode_barang" placeholder="">
			</div>
		</div>
        <div class="form-group row">
			<label for="nama_barang" class="col-sm-12 col-md-2 col-form-label text-white">Nama Barang</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="text" name="nama_barang" id="nama_barang" value="{{ $barang->nama_barang }}" aria-describedby="nama_barang" placeholder="">
			</div>
		</div>
        <div class="form row">
			<label for="id_container" class="col-sm-12 col-md-2 col-form-label text-white">Container</label>
            <div class="col-sm-12 col-md-10">
                <div class="input-group">
                    <input id="container_nama" type="text" class="form-control" value="{{ $barang->container->nama_container }}" readonly="" required>
                    <input id="id_container" type="hidden" name="id_container" value="{{ $barang->id_container }}" required readonly="">
                    <button type="button" class="btn btn-info btn-secondary" data-toggle="modal" data-target="#myModal"><b>Cari Container </b><span class="fa fa-search"></span></button>
                </div>
            </div>
		</div>
        <div class="form row">
			<label for="id_transaksi" class="col-sm-12 col-md-2 col-form-label text-white">Transaksi</label>
            <div class="col-sm-12 col-md-10">
                <div class="input-group">
                    <input id="transaksi_nama" type="text" class="form-control" value="{{ $barang->transaksi->nama }}" readonly="" required>
                    <input id="id_transaksi" type="hidden" name="id_transaksi" value="{{ $barang->id_transaksi }}" required readonly="">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal2"><b>Cari Transaksi </b><span class="fa fa-search"></span></button>
                </div>
            </div>
		</div>
        <div class="form-group row">
			<label for="merk_barang" class="col-sm-12 col-md-2 col-form-label text-white">Merk Barang</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="text" name="merk_barang" id="merk_barang" value="{{ $barang->merk_barang }}" aria-describedby="merk_barang" placeholder="">
			</div>
		</div>
        <div class="form-group row">
			<label for="bahan" class="col-sm-12 col-md-2 col-form-label text-white">Bahan</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="text" name="bahan" id="bahan" value="{{ $barang->bahan }}" aria-describedby="bahan" placeholder="">
			</div>
		</div>
		<div class="form-group row">
			<label for="jumlah_barang" class="col-sm-12 col-md-2 col-form-label text-white">Jumlah</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="number" name="jumlah_barang" id="jumlah_barang" value="{{ $barang->jumlah_barang }}" aria-describedby="jumlah_barang" placeholder="">
			</div>
		</div>
        <div class="form-group row">
			<label for="harga" class="col-sm-12 col-md-2 col-form-label text-white">Harga Satuan</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="number" name="harga" id="harga" value="{{ $barang->harga }}" aria-describedby="harga" placeholder="">
			</div>
		</div>
        <div class="form-group row">
			<label for="tgl_input" class="col-sm-12 col-md-2 col-form-label text-white">Tanggal Beli</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="date" name="tgl_input" id="tgl_input" value="{{ $barang->tgl_input }}" aria-describedby="tgl_input" placeholder="">
			</div>
		</div>
        <div class="form-group row">
            <label for="gambar" class="col-sm-2 col-form-label text-white">Gambar</label>
            <div class="col-sm-10">
                <img class="product" width="200" height="200" @if($barang->gambar) src="{{ asset('storage/'.$barang->gambar) }}" @endif />
                <input type="file" class="uploads form-control" style="margin-top: 20px;" name="gambar">
            </div>
        </div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label"></label>
			<div class="col-sm-10">
				<button type="submit" class="btn btn-primary">Submit</button>
				<button type="reset" class="btn btn-danger">Reset</button>
                <div class="pull-right">
                    <a href="{{route('barang.index')}}" type="button" class="btn" data-bgcolor="#3b5998" data-color="#ffffff">
                        <i class="icon-copy fa fa-arrow-left" aria-hidden="true"></i>
                        Kembali
                    </a>
                </div>
			</div>
		</div>
	</form>
</div>
<!-- Default Basic Forms End -->

<!-- Modal Container -->
<div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document" >
        <div class="modal-content" style="background: #fff;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cari Container</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="lookup" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Container</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($container as $data)
                        <tr class="pilih_container" data-id_container="<?php echo $data->id; ?>" data-container_nama="<?php echo $data->nama_container; ?>" >
                            <td>{{$loop->iteration}}</td>
                            <td>{{$data->kode_container}}</td>
                            <td>{{$data->nama_container}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Container -->

<!-- Modal Transaksi -->
<div class="modal fade bd-example-modal-lg" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document" >
        <div class="modal-content" style="background: #fff;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cari Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="lookup" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>ID Transaksi</th>
                            <th>Nama</th>
                            <th>Penyedia</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaksi as $data)
                        <tr class="pilih_transaksi" data-id_transaksi="<?php echo $data->kode; ?>" data-transaksi_nama="<?php echo $data->nama; ?>" >
                            <td>{{$data->kode}}</td>
                            <td>{{$data->nama}}</td>
                            <td>{{$data->penyedia}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Transaksi -->

<script>
    $(document).ready(function(){
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
</script>
<script type="text/javascript">
    $(document).on('click', '.pilih_container', function (e) {
        document.getElementById("container_nama").value = $(this).attr('data-container_nama');
        document.getElementById("id_container").value = $(this).attr('data-id_container');
        $('#myModal').modal('hide');
    });

    $(document).on('click', '.pilih_transaksi', function (e) {
        document.getElementById("transaksi_nama").value = $(this).attr('data-transaksi_nama');
        document.getElementById("id_transaksi").value = $(this).attr('data-id_transaksi');
        $('#myModal2').modal('hide');
    });

    $(function () {
        $("#lookup, #lookup2").dataTable();
    });
</script>
@endsection
