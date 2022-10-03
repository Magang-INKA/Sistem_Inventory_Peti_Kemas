@extends('layouts.MasterView')
@section('menu_transaksi', 'active')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Create Kapal</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('kapal.index') }}">Kapal</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
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
	<form method="POST" action="{{ route('kapal.store') }}" id="myForm">
        @csrf
        <div class="form-group row">
			<label for="nama_kapal" class="col-sm-12 col-md-2 col-form-label text-white">Nama Kapal</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="text" name="nama_kapal" id="nama_kapal" aria-describedby="nama_kapal" placeholder="">
			</div>
		</div>
        <div class="form row">
			<label for="id_keberangkatan" class="col-sm-12 col-md-2 col-form-label text-white">Keberangkatan</label>
            <div class="col-sm-12 col-md-10">
                <div class="input-group">
                    <input id="nama_pelabuhan1" type="text" class="form-control" readonly="" required>
                    <input id="id_keberangkatan" type="hidden" name="id_keberangkatan" value="{{ old('id_keberangkatan') }}" required readonly="">
                    <button type="button" class="btn btn-info btn-secondary" data-toggle="modal" data-target="#myModal"><b>Cari Pelabuhan </b><span class="fa fa-search"></span></button>
                </div>
            </div>
		</div>
        <div class="form row">
			<label for="id_tujuan" class="col-sm-12 col-md-2 col-form-label text-white">Tujuan</label>
            <div class="col-sm-12 col-md-10">
                <div class="input-group">
                    <input id="nama_pelabuhan2" type="text" class="form-control" readonly="" required>
                    <input id="id_tujuan" type="hidden" name="id_tujuan" value="{{ old('id_tujuan') }}" required readonly="">
                    <button type="button" class="btn btn-info btn-secondary" data-toggle="modal" data-target="#myModal1"><b>Cari Pelabuhan </b><span class="fa fa-search"></span></button>
                </div>
            </div>
		</div>
        <div class="form-group row">
			<label for="jadwal" class="col-sm-12 col-md-2 col-form-label text-white">Jadwal</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="date" name="jadwal" id="jadwal" aria-describedby="jadwal" placeholder="">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label"></label>
			<div class="col-sm-10">
				<button type="submit" class="btn btn-primary">Submit</button>
				<button type="reset" class="btn btn-danger">Reset</button>
                <div class="pull-right">
                    <a href="{{route('kapal.index')}}" type="button" class="btn" data-bgcolor="#3b5998" data-color="#ffffff">
                        <i class="icon-copy fa fa-arrow-left" aria-hidden="true"></i>
                        Kembali
                    </a>
                </div>
			</div>
		</div>
	</form>
</div>
<!-- Default Basic Forms End -->
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document" >
        <div class="modal-content" style="background: #fff;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cari Pelabuhan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="lookup" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>ID Pelabuhan</th>
                            <th>Nama Pelabuhan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pelabuhan as $data)
                        <tr class="pilih" data-id="<?php echo $data->id; ?>" data-nama_pelabuhan="<?php echo $data->nama_pelabuhan; ?>" >
                            <td>{{$data->id}}</td>
                            <td>{{$data->nama_pelabuhan}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-lg" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document" >
        <div class="modal-content" style="background: #fff;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cari Pelabuhan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="lookup" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>ID Pelabuhan</th>
                            <th>Nama Pelabuhan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pelabuhan as $data)
                        <tr class="pilih2" data-id_tujuan="<?php echo $data->id; ?>" data-nama_pelabuhan="<?php echo $data->nama_pelabuhan; ?>" >
                            <td>{{$data->id}}</td>
                            <td>{{$data->nama_pelabuhan}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->
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
    $(document).on('click', '.pilih', function (e) {
        document.getElementById("nama_pelabuhan1").value = $(this).attr('data-nama_pelabuhan');
        document.getElementById("id_keberangkatan").value = $(this).attr('data-id');
        $('#myModal').modal('hide');
    });

    $(document).on('click', '.pilih2', function (e) {
        document.getElementById("nama_pelabuhan2").value = $(this).attr('data-nama_pelabuhan');
        document.getElementById("id_tujuan").value = $(this).attr('data-id_tujuan');
        $('#myModal1').modal('hide');
    });

    $(function () {
        $("#lookup, #lookup2, #lookup3").dataTable();
    });
</script>
@endsection
