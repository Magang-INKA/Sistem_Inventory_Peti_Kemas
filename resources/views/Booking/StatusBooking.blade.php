@extends('layouts.MasterView')
@section('status_booking', 'active')
@section('content')
<div class="card border-danger" >
	<div class="card-header">
		Booking Status
	</div>

	<div class="pd-20 card-box mb-30">
        <form>
            <div class="form-group row">
                <label for="no_resi" class="col-sm-12 col-md-2 col-form-label text-white">No Resi</label>
                <div class="col-sm-12 col-md-10">
                    @foreach ($bookings as $item)
                    <input class="form-control" type="text" name="no_resi" id="no_resi"
                    value="{{ $item->no_resi }}" aria-describedby="no_resi"  disabled="">
                    @endforeach
                </div>
            </div>
            <div class="form-group row">
                <label for="status" class="col-sm-12 col-md-2 col-form-label text-white">Nama Container</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="status" id="status"
                    value="{{ $bookings->status }}" aria-describedby="status" placeholder="Disabled input" disabled="">
                </div>
            </div>
            {{-- <div class="form-group row">
                <label for="id_pelabuhan" class="col-sm-12 col-md-2 col-form-label text-white">Tujuan</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="id_pelabuhan" id="id_pelabuhan"
                    value="{{ $container->pelabuhan->nama_pelabuhan }}" aria-describedby="id_pelabuhan"  disabled="">
                </div>
            </div> --}}
            <div class="pull-right">
                <a href="{{route('container.index')}}" type="button" class="btn" data-bgcolor="#3b5998" data-color="#ffffff">
                    <i class="icon-copy fa fa-arrow-left" aria-hidden="true"></i>
                    Kembali
                </a>
            </div>
            <br><br>
        </form>

    </div>

    <br>
</div>
@endsection
