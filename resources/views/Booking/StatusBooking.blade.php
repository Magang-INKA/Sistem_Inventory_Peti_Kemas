@extends('layouts.MasterView')
@section('status_booking', 'active')
@section('content')
<div class="card border mb-30" >
	<div class="card-header">
		Booking Status
	</div>

	<div class="pd-20">
        <form>
            <div class="form-group row">
                <label for="no_resi" class="col-sm-12 col-md-2 col-form-label">No Resi</label>
                <div class="col-sm-12 col-md-10">
                    @foreach ($book as $br => $data)
                    <input class="form-control" type="text" name="no_resi" id="no_resi"
                    value="{{ $data->no_resi }}" aria-describedby="no_resi"  disabled="">
                    @endforeach
                </div>
            </div>
            <div class="form-group row">
                <label for="status" class="col-sm-12 col-md-2 col-form-label">Status Booking</label>
                <div class="col-sm-12 col-md-10">
                    @foreach ($book as $br => $data)
                    <input class="form-control" type="text" name="status" id="status"
                    value="{{ $data->status }}" aria-describedby="status" placeholder="Disabled input" disabled="">
                    @endforeach
                </div>
            </div>
            <div class="form-group row">
                <label for="status" class="col-sm-12 col-md-2 col-form-label">Note</label>
                <div class="col-sm-12 col-md-10">
                    @foreach ($book as $br => $data)
                    <input class="form-control" type="text" name="status" id="status"
                    value="{{ $data->catatan }}" aria-describedby="status" placeholder="Disabled input" disabled="">
                    @endforeach
                </div>
            </div>
            @foreach ($book as $br => $data)
                @if($data->status == 'terima')
                <div class="pull-right">
                    <a href="{{route('cekResi')}}" type="button" class="btn" data-bgcolor="#3b5998" data-color="#ffffff">
                        <i class="icon-copy" aria-hidden="true"></i>
                        Cek Resi
                    </a>
                </div>
                @endif
            @endforeach
            <br><br>
        </form>

    </div>

    <br>
</div>
@endsection
