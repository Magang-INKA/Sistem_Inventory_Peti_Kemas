@extends('layouts.MasterView')
@section('menu_jadwal_kapal', 'active')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Edit Vessel Schedule</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ route('JadwalKapal.index') }}">Vessel Schedule</a></li>
                    <li class="breadcrumb-item" aria-current="page">Edit</li>
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
	<form method="POST" action="{{ route('JadwalKapal.update' , $jadwalKapal->id) }}" id="myForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form row">
			<label for="id_trip" class="col-sm-12 col-md-2 col-form-label text-white">ID Trip</label>
            <div class="col-sm-12 col-md-10">
                <div class="input-group">
                    <input id="nama_trip" type="hidden"  readonly="" required>
                    <input id="id_trip" type="text" class="form-control" name="id_trip" value="{{ $jadwalKapal->trip->id }}" required readonly="">
                    <button type="button" class="btn btn-info btn-secondary" data-toggle="modal" data-target="#myModal1"><b>Cari Trip </b><span class="fa fa-search"></span></button>
                </div>
            </div>
		</div>
        <div class="form row">
			<label for="" class="col-sm-12 col-md-2 col-form-label text-white">Vessel Name</label>
            <div class="col-sm-12 col-md-10">
                <div class="input-group">
                    <input id="" type="text" class="form-control" name="" value="{{ $jadwalKapal->trip->kapal->nama_kapal }}" required readonly="" aria-disabled="">
                </div>
            </div>
		</div>
        <div class="form row">
			<label for="asal_pelabuhan_id" class="col-sm-12 col-md-2 col-form-label text-white">Port of Departure</label>
            <div class="col-sm-12 col-md-10">
                <div class="input-group">
                    <input id="nama_pelabuhan1" type="text" class="form-control" value="{{  $jadwalKapal->awal->nama_pelabuhan }}" readonly="" required>
                    <input id="asal_pelabuhan_id" type="hidden" name="asal_pelabuhan_id" value="{{  $jadwalKapal->awal->kode_pelabuhan }}" required readonly="">
                    <button type="button" class="btn btn-info btn-secondary" data-toggle="modal" data-target="#myModal2"><b>Cari Pelabuhan </b><span class="fa fa-search"></span></button>
                </div>
            </div>
		</div>
        <div class="form row">
			<label for="tujuan_pelabuhan_id" class="col-sm-12 col-md-2 col-form-label text-white">Destination Port</label>
            <div class="col-sm-12 col-md-10">
                <div class="input-group">
                    <input id="nama_pelabuhan2" type="text" class="form-control" value="{{  $jadwalKapal->tujuan->nama_pelabuhan }}" readonly="" required>
                    <input id="tujuan_pelabuhan_id" type="hidden" name="tujuan_pelabuhan_id" value="{{  $jadwalKapal->tujuan->kode_pelabuhan }}" required readonly="">
                    <button type="button" class="btn btn-info btn-secondary" data-toggle="modal" data-target="#myModal3"><b>Cari Pelabuhan </b><span class="fa fa-search"></span></button>
                </div>
            </div>
		</div>
        <div class="form-group row">
			<label for="ETA_awal" class="col-sm-12 col-md-2 col-form-label text-white">ETA at the Port of Departure</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="datetime-local" name="ETA_awal" value="{{ $jadwalKapal->ETA_awal }}" id="ETA_awal" aria-describedby="ETA_awal" placeholder="">
			</div>
		</div>
        <div class="form-group row">
			<label for="ETD_awal" class="col-sm-12 col-md-2 col-form-label text-white">ETD at the Port of Departure</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="datetime-local" name="ETD_awal" value="{{ $jadwalKapal->ETD_awal }}" id="ETD_awal" aria-describedby="ETD_awal" placeholder="">
			</div>
		</div>
        <div class="form-group row">
			<label for="ETA_tujuan" class="col-sm-12 col-md-2 col-form-label text-white">ETA at the Destination Port</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="datetime-local" name="ETA_tujuan" value="{{ $jadwalKapal->ETA_tujuan }}" id="ETA_tujuan" aria-describedby="ETA_tujuan" placeholder="">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label"></label>
			<div class="col-sm-10">
				<button type="submit" class="btn btn-primary">Submit</button>
				<button type="reset" class="btn btn-danger">Reset</button>
                <div class="pull-right">
                    <a href="{{route('JadwalKapal.index')}}" type="button" class="btn" data-bgcolor="#3b5998" data-color="#ffffff">
                        <i class="icon-copy fa fa-arrow-left" aria-hidden="true"></i>
                        Kembali
                    </a>
                </div>
			</div>
		</div>
	</form>
</div>
<!-- Default Basic Forms End -->
<div class="modal fade bd-example-modal-lg" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document" >
        <div class="modal-content" style="background: #fff;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cari Trip</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="lookup" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>ID Trip</th>
                            <th>Nama Trip</th>
                            <th>Asal Pelabuhan</th>
                            <th>Tujuan Pelabuhan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($trip as $data)
                        <tr class="pilih1" data-id_trip="<?php echo $data->id; ?>" data-nama_trip="<?php echo $data->nama_trip; ?>" >
                            <td>{{$data->id}}</td>
                            <td>{{$data->nama_trip}}</td>
                            <td>{{$data->keberangkatan->nama_pelabuhan}}</td>
                            <td>{{$data->tujuan->nama_pelabuhan}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-lg" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
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
                            <th>Kode Pelabuhan</th>
                            <th>Nama Pelabuhan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pelabuhan as $data)
                        <tr class="pilih2" data-asal_pelabuhan="<?php echo $data->kode_pelabuhan; ?>" data-nama_pelabuhan="<?php echo $data->nama_pelabuhan; ?>" >
                            <td>{{$data->kode_pelabuhan}}</td>
                            <td>{{$data->nama_pelabuhan}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-lg" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
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
                            <th>Kode Pelabuhan</th>
                            <th>Nama Pelabuhan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pelabuhan as $data)
                        <tr class="pilih3" data-tujuan_pelabuhan="<?php echo $data->kode_pelabuhan; ?>" data-nama_pelabuhan="<?php echo $data->nama_pelabuhan; ?>" >
                            <td>{{$data->kode_pelabuhan}}</td>
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

    $(document).on('click', '.pilih1', function (e) {
        document.getElementById("nama_trip").value = $(this).attr('data-nama_trip');
        document.getElementById("id_trip").value = $(this).attr('data-id_trip');
        $('#myModal1').modal('hide');
    });

    $(document).on('click', '.pilih2', function (e) {
        document.getElementById("nama_pelabuhan1").value = $(this).attr('data-nama_pelabuhan');
        document.getElementById("asal_pelabuhan_id").value = $(this).attr('data-asal_pelabuhan');
        $('#myModal2').modal('hide');
    });

    $(document).on('click', '.pilih3', function (e) {
        document.getElementById("nama_pelabuhan2").value = $(this).attr('data-nama_pelabuhan');
        document.getElementById("tujuan_pelabuhan_id").value = $(this).attr('data-tujuan_pelabuhan');
        $('#myModal3').modal('hide');
    });

    $(function () {
        $("#lookup, #lookup2, #lookup3").dataTable();
    });

    $(function () {
        $('.datetimepicker').datetimepicker();
    });
</script>
@endsection
