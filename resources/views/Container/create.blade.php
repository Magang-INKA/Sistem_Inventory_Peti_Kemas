@extends('layouts.MasterView')
@section('menu_container', 'active')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Create Container</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('container.index') }}">Container</a></li>
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
	<form method="POST" action="{{ route('container.store') }}" id="myForm">
        @csrf
		<div class="form-group row">
			<label for="id_kapal" class="col-sm-12 col-md-2 col-form-label text-white">Nama Kapal</label>
			<div class="col-sm-12 col-md-10">
                <div class="input-group">
                    <input id="nama_kapal" type="text" class="form-control" readonly="" required>
                    <input id="id_kapal" type="hidden" name="id_kapal" value="{{ old('id_kapal') }}" required readonly="">
                    <button type="button" class="btn btn-info btn-secondary" data-toggle="modal" data-target="#myModal"><b>Cari Kapal</b><span class="fa fa-search"></span></button>
                </div>
            </div>
		</div>
		<div class="form-group row">
			<label for="nama_container" class="col-sm-12 col-md-2 col-form-label text-white">Nama Container</label>
			<div class="col-sm-12 col-md-10">
				<input class="form-control" type="text" name="nama_container" id="nama_container" aria-describedby="nama_container" placeholder="">
			</div>
		</div>
		<div class="form-group row">
			<label for="id_pelabuhan" class="col-sm-12 col-md-2 col-form-label text-white">Nama Pelabuhan</label>
			<div class="col-sm-12 col-md-10">
                <div class="input-group">
                    <input id="nama_pelabuhan" type="text" class="form-control" readonly="" required>
                    <input id="id_pelabuhan" type="hidden" name="id_pelabuhan" value="{{ old('id_pelabuhan') }}" required readonly="">
                    <button type="button" class="btn btn-info btn-secondary" data-toggle="modal" data-target="#myModal1"><b>Cari Pelabuhan</b><span class="fa fa-search"></span></button>
                </div>
            </div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label"></label>
			<div class="col-sm-10">
				<button type="submit" class="btn btn-primary">Submit</button>
				<button type="reset" class="btn btn-danger">Reset</button>
                <div class="pull-right">
                    <a href="{{route('container.index')}}" type="button" class="btn" data-bgcolor="#3b5998" data-color="#ffffff">
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
                <h5 class="modal-title" id="exampleModalLabel">Cari Kapal </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="lookup" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>ID Kapal</th>
                            <th>Nama Kapal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kapal as $data)
                        <tr class="pilih" data-id="<?php echo $data->id; ?>" data-nama_kapal="<?php echo $data->nama_kapal; ?>" >
                            <td>{{$data->id}}</td>
                            <td>{{$data->nama_kapal}}</td>
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
                <h5 class="modal-title" id="exampleModalLabel">Cari Pelabuhan </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="lookup" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>ID Pelabuhan</th>
                            <th>Nama Pelabuhan Tujuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pelabuhan as $data)
                        <tr class="pilih2" data-id_pelabuhan="<?php echo $data->id; ?>" data-nama_pelabuhan="<?php echo $data->nama_pelabuhan; ?>" >
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
        document.getElementById("nama_kapal").value = $(this).attr('data-nama_kapal');
        document.getElementById("id_kapal").value = $(this).attr('data-id');
        $('#myModal').modal('hide');
    });

    $(document).on('click', '.pilih2', function (e) {
        document.getElementById("nama_pelabuhan").value = $(this).attr('data-nama_pelabuhan');
        document.getElementById("id_pelabuhan").value = $(this).attr('data-id_pelabuhan');
        $('#myModal1').modal('hide');
    });

    $(function () {
        $("#lookup, #lookup2, #lookup3").dataTable();
    });
</script>
@endsection
