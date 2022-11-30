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
            <button type="submit" name="action" class="btn btn-primary" value="gantijadwal">Ganti Jadwal</button>

         <span class="input-group-btn">
            <button type="button" class="btn btn-info btn-secondary" data-toggle="modal" data-target="#myModal"><b>Cari Jadwal</b> <span class="fa fa-search"></span></button>
         </span> {{-- <input name="id_jadwal" value="{{ $jadwal_decode }}" type="text" class="form-control" readonly> --}}
         </div>

		</div>
      {{-- <div class="form-group row">
			<label for="role" class="col-sm-12 col-md-2 col-form-label">Container</label>
			<div class="col-sm-12 col-md-10">
				<input name="address" class="form-control" rows="3" value="{{ $booking->container }}">
			</div>
		</div> --}}
        <div class="form-group row">
			<label for="id_container" class="col-sm-12 col-md-2 col-form-label">Container</label>
			<div class="col-sm-12 col-md-10">
                <div class="input-group">
                    <input id="id_container" type="text" class="form-control" name="id_container" value="{{ $booking->id_container }}" required readonly="">
                    <button type="button" class="btn btn-info btn-secondary" data-toggle="modal" data-target="#myModal2"><b>Cari Container</b><span class="fa fa-search"></span></button>
                </div>
            </div>
		</div>

      <div class="form-group row">
			<label for="gambar" class="col-sm-12 col-md-2 col-form-label">Jenis Barang</label>
			<div class="col-sm-12 col-md-10">
            <input id="id_container" type="hidden" class="form-control" name="id_barang" value="{{ $booking->id_barang }}" required readonly="">
            <select name="country" class="form-control custom-select">
                <option value="">Jenis Barang</option>
                @foreach($jb as $jenisbarang)
                  <option value="{{ $jenisbarang->id }}" @if($jenisbarang->id == $jb->jenisbarang) selected @endif>{{ $jenisbarang->nama_barang }}</option>
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
			<label for="gambar" class="col-sm-12 col-md-2 col-form-label">Status</label>
			<div class="col-sm-12 col-md-10">
                <select class="custom-select col-12" type="status" name="status" id="status">
                    <option value="belum" @if($booking->status == 'belum') selected @endif>Belum</option>
                    <option value="reschedule" @if($booking->status == 'reschedule') selected @endif>Reschedule</option>
                    <option value="terima" @if($booking->status == 'terima') selected @endif>Terima</option>
                </select>
            </div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label"></label>
			<div class="col-sm-10">
				<button type="submit" name="action" class="btn btn-primary" value="save">Submit</button>
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
                            <th>No Container</th>
                            <th>jenis_container</th>
                            <th>kapasitas</th>
                            <th>suhu_ketetapan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($container as $data)
                        <tr class="pilih2" data-id="<?php echo $data->id; ?>" >
                            {{-- <td>{{$data->id}}</td> --}}
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

            $(document).on('click', '.pilih2', function (e) {
                document.getElementById("id_container").value = $(this).attr('data-id');
                $('#myModal2').modal('hide');
            });

             $(function () {
                $("#lookup, #lookup2").dataTable();
            });

        </script>


<!-- Default Basic Forms End -->
@endsection
