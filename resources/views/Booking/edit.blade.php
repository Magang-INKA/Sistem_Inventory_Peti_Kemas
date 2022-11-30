@extends('layouts.MasterView')
@section('menu_user', 'active')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Edit Booking</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('booking.index') }}">Booking</a></li>
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
<div class="pd-20 card-white mb-30">
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
	<form method="POST" action="{{ route('booking.update', $booking->id) }}" id="myForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')
		<div class="form-group row">
			<label for="no_telp" class="col-sm-12 col-md-2 col-form-label">No Resi</label>
			<div class="col-sm-12 col-md-10">
            <input name="no_resi" value="{{ $booking->no_resi }}" type="text" class="form-control" >
			</div>
		</div>
        <div class="form-group row">
			<label for="no_telp" class="col-sm-12 col-md-2 col-form-label">Pengirim</label>
			<div class="col-sm-12 col-md-10">
            <input name="id_user" value="{{ $booking->id_user }}" type="text" class="form-control" >
			</div>
		</div>
		<div class="form-group row">
         <label for="jadwal" class="col-sm-12 col-md-2 col-form-label">Jadwal</label>
			<div class="col-sm-12 col-md-10">
            <table id="lookup" class="table table-bordered table-hover table-striped">
             <thead>
                 <tr>
                     <th>ID Jadwal</th>
                     <th>Asal</th>
                     <th>Tujuan</th>
                     <th>ETA</th>
                     <th>ETD</th>
                     <th>Nama Kapal</th>
                 </tr>
             </thead>
             <tbody>
                 @foreach($jadwal as $data)
                 <tr>
                  <td>{{$data->id_jadwal}}</td>
                  <td>{{$data->asal}}</td>
                  <td>{{$data->tujuan}}</td>
                  <td>{{$data->ETA}}</td>
                  <td>{{$data->ETD}}</td>
                  <td>{{$data->nama_kapal}}</td>
                 </tr>
                 @endforeach
             </tbody>
         </table>

         <input id="id_jadwal" type="text" name="id_jadwal" value="{{ $booking->id_jadwal }}" required readonly>
         <span class="input-group-btn">
            <button type="button" class="btn btn-info btn-secondary" data-toggle="modal" data-target="#myModal"><b>Cari Jadwal</b> <span class="fa fa-search"></span></button>
         </span> {{-- <input name="id_jadwal" value="{{ $jadwal_decode }}" type="text" class="form-control" readonly> --}}
         </div>

		</div>
      <div class="form-group row">
			<label for="role" class="col-sm-12 col-md-2 col-form-label">Container</label>
			<div class="col-sm-12 col-md-10">
				<input name="address" class="form-control" rows="3" value="{{ $booking->id_container }}">
			</div>
		</div>

      <div class="form-group row">
			<label for="gambar" class="col-sm-12 col-md-2 col-form-label">Jenis Barang</label>
			<div class="col-sm-12 col-md-10">
            <select class="custom-select col-12" type="role" name="jenis_barang" id="role">
               @foreach($jb as $jenisbarang)
                   <option value="{{ $jenisbarang->id }}">{{ $jenisbarang->jenis_barang }}</option>
                @endforeach
           </select>
			</div>
		</div>
      <div class="form-group row">
			<label for="gambar" class="col-sm-12 col-md-2 col-form-label">Nama Barang</label>
			<div class="col-sm-12 col-md-10">
            <input id="nama_barang" class="form-control" name="nama_barang" value="{{ $barang->nama_barang }}" required >
			</div>
		</div>
      <div class="form-group row">
			<label for="gambar" class="col-sm-12 col-md-2 col-form-label">Berat Barang</label>
			<div class="col-sm-12 col-md-10">
            <input id="nama_barang" class="form-control" name="berat_barang" value="{{ $barang->berat_barang }}" required >
			</div>
		</div>
      <div class="form-group row">
			<label for="gambar" class="col-sm-12 col-md-2 col-form-label">Nama Penerima</label>
			<div class="col-sm-12 col-md-10">
            <input id="nama_barang" class="form-control" name="nama_penerima" value="{{ $booking->nama_penerima }}" required >
			</div>
		</div>
      <div class="form-group row">
			<label for="gambar" class="col-sm-12 col-md-2 col-form-label">Telepon Penerima</label>
			<div class="col-sm-12 col-md-10">
            <input id="nama_barang" class="form-control" name="telp_penerima" value="{{ $booking->telp_penerima }}" required >
			</div>
		</div>
      <div class="form-group row">
			<label for="gambar" class="col-sm-12 col-md-2 col-form-label">Alamat Penerima</label>
			<div class="col-sm-12 col-md-10">
            <input id="nama_barang" class="form-control" name="alamat_penerima" value="{{ $booking->alamat_penerima }}" required >
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label"></label>
			<div class="col-sm-10">
				<button type="submit" class="btn btn-primary">Submit</button>
				<button type="reset" class="btn btn-danger">Reset</button>
                <div class="pull-right">
                    <a href="{{route('booking.index')}}" type="button" class="btn" data-bgcolor="#3b5998" data-color="#ffffff">
                        <i class="icon-copy fa fa-arrow-left" aria-hidden="true"></i>
                        Kembali
                    </a>
                </div>
			</div>
		</div>
	</form>
</div>
  {{-- Modal Jadwal--}}

  <div class="modal fade bd-example-modal-xl" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
   <div class="modal-dialog modal-xl" role="document" >
       <div class="modal-content" style="background: #fff;">
           <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Cari Jadwal</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <div class="modal-body">
            <input class="form-control" id="myInput" type="text" placeholder="Search..">
               <table id="lookup" class="table table-bordered table-hover table-striped">
                   <thead>
                       <tr>
                           <th> ID Jadwal </th>
                           <th> ID Trip </th>
                           <th> Pelabuhan Awal </th>
                           <th> Pelabuhan tujuan </th>
                           <th> Kapal </th>
                           <th> Kode Container </th>
                           {{-- <th> Jenis Container </th> --}}
                           <th> Kapasitas </th>
                           <th> ETA </th>
                           <th> ETD </th>
                       </tr>
                   </thead>
                   <tbody>
                       @foreach($tjadwal as $data)
                       <tr class="pilih" data-id_jadwal="<?php echo $data->id; ?>">
                        <td>{{$data->id}}</td>
                        <td>{{$data->id_trip}}</td>
                           <td>
                               {{$data->awal->nama_pelabuhan}}
                           </td>
                           <td>{{$data->tujuan->nama_pelabuhan}}</td>
                           <td>{{$data->nama_kapal}}</td>
                           <td>{{$data->no_container}}</td>
                           {{-- <td>{{$data->tujuan_pelabuhan_id}}</td> --}}
                           <td>{{$data->kapasitas}}</td>
                           <td>{{$data->ETA}}</td>
                           <td>{{$data->ETD}}</td>
                       </tr>
                       @endforeach
                   </tbody>
               </table>
           </div>
       </div>
   </div>
</div>

{{-- Script --}}
<script type="text/javascript">
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#lookup tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

});
   $(document).on('click', '.pilih', function (e) {
                document.getElementById("id_jadwal").value = $(this).attr('data-id_jadwal');
                $('#myModal').modal('hide');
            });

             $(function () {
                $("#lookup").dataTable();
            });

        </script>


<!-- Default Basic Forms End -->
@endsection
