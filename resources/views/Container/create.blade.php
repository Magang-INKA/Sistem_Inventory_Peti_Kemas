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
                    <li class="breadcrumb-item active"><a href="{{ route('container.index') }}">Container</a></li>
                    <li class="breadcrumb-item" aria-current="page">Create</li>
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
			<label for="id_kapal" class="col-sm-12 col-md-2 col-form-label text-white">Vessel Name</label>
			<div class="col-sm-12 col-md-10">
                <div class="input-group">
                    <input id="IMO" type="text" class="form-control" readonly="" value="{{ old('IMO') }}" required readonly="">
                    <input id="id_kapal" type="hidden" name="id_kapal" class="form-control" value="{{ old('id_kapal') }}" required readonly="">
                    <button type="button" class="btn btn-info btn-secondary" data-toggle="modal" data-target="#myModal"><b>Cari Kapal</b><span class="fa fa-search"></span></button>
                </div>
            </div>
		</div>
		<div class="form-group row">
			<label for="no_container" class="col-sm-12 col-md-2 col-form-label text-white">No Container</label>
			<div class="col-sm-12 col-md-10">
                <div class="input-group">
                    {{-- <input id="no_container" type="text" class="form-control" readonly="" required> --}}
                    <input id="no_container" type="text" class="form-control" name="no_container" value="{{ old('no_container') }}" required readonly="">
                    <button type="button" class="btn btn-info btn-secondary" data-toggle="modal" data-target="#myModal2"><b>Cari Container</b><span class="fa fa-search"></span></button>
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
                            <th>Vessel Name</th>
                            <th>IMO</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kapal as $data)
                        <tr class="pilih" data-id_kapal="<?php echo $data->id; ?>" data-IMO="<?php echo $data->nama_kapal; ?>">
                            <td>{{$data->nama_kapal}}</td>
                            <td>{{$data->IMO}}</td>
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
                <h5 class="modal-title" id="exampleModalLabel">Cari Container </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="lookup" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Container Number</th>
                            <th>Container Type</th>
                            <th>Capacity</th>
                            <th>Temperature</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($container as $data)
                        <tr class="pilih2" data-no_container="<?php echo $data->no_container; ?>" >
                            <td>{{$data->no_container}}</td>
                            <td>{{$data->jenis_container}}</td>
                            <td>{{$data->kapasitas}}</td>
                            <td>{{$data->suhu_ketetapan}}</td>
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
        document.getElementById("IMO").value = $(this).attr('data-IMO');
        document.getElementById("id_kapal").value = $(this).attr('data-id_kapal');
        $('#myModal').modal('hide');
    });

    $(document).on('click', '.pilih2', function (e) {
        document.getElementById("no_container").value = $(this).attr('data-no_container');
        $('#myModal2').modal('hide');
    });

    $(function () {
        $("#lookup, #lookup2, #lookup3").dataTable();
    });
</script>
@endsection
