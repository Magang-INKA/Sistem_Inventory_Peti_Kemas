@extends('layouts.MasterView')
@section('menu_booking', 'active') 
@section('content')
    {{-- <div class="main-container"> --}}
    <div class="pd-20 card-box mb-30">
        {{-- @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                                <h4>Form Booking</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Form Booking</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="pd-20 card-white mb-30">
                    <div class="clearfix">
                        <h4 class="text-blue h4">Booking Step</h4>
                    </div>
                    <div class="wizard-content">
                        <form method="POST" action="{{ route('booking.store') }}" id="myForm"
                            class="tab-wizard wizard-circle wizard" enctype="multipart/form-data">
                            @csrf
                            <h5>Pilih Jadwal</h5>
                            <section>
                                <div class="row">
                                    <div class="col-md-6" style="">
                                        <div class="form-group">
                                            <label for="id_container">Pilih Container :</label><br>
                                            <select class="form-control" name="id_container" id="id_container">
                                                @foreach ($containers as $container)
                                                    <option value="{{ $container->id }}">{{ $container->nama_container }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="date">Pilih Jadwal :</label>
                                            <input class="form-control" type="date" name="date" id="date"
                                                aria-describedby="date" placeholder="">
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-6" hidden>
										<div class="form-group">
											<label for="id_user">ID User</label>
											<input type="text" class="form-control" placeholder="id_user" name="id_user" id="id_user" value="{{Auth()->user()->id}}">
										</div>
									</div> --}}
                                    {{-- <div class="col-md-6">
										<div class="form-group">
											<label for="id_user">User</label>
											<input type="text" class="form-control" placeholder="user" name="id_user" id="id_user" value="{{ $booking->user->id }}">
										</div>
									</div> --}}
                                </div>
                            </section>
                            <!-- Step 2 -->
                            <h5>Data Barang</h5>
                            <section>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_barang">Nama Barang :</label>
                                            <input type="text" class="form-control" name="nama_barang" id="nama_barang">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jumlah_barang">Jumlah Barang :</label>
                                            <input type="number" class="form-control" name="jumlah_barang"
                                                id="jumlah_barang">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="berat">Berat(kg) :</label>
                                            <input type="number" class="form-control" name="berat" id="berat">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="requirement">Requirement :</label>
                                            <input type="text" class="form-control" name="requirement" id="requirement">
                                        </div>
                                    </div>
                                    <div class="col-md-6" hidden>
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <input type="text" class="form-control" name="status" id="status"
                                                value="1">
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!-- Step 3 -->
                            <h5>Data Penerima</h5>
                            <section>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_penerima">Nama Penerima :</label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email :</label>
                                            <input type="email" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="alamat">Alamat :</label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="no_telp">Nomor Telepon :</label>
                                            <input class="form-control" type="text">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" style="display:none;"></button>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <button type="submit" style="display:none;"></button>
                                        {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
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

                    {{-- submit button --}}

                </div>

                <!-- success Popup html Start -->
                {{-- <div class="modal fade" id="success-modal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body text-center font-18">
                                <h3 class="mb-20">Form Submitted!</h3>
                                <div class="mb-30 text-center"><img src="{{ asset('vendors/images/success.png') }}"></div>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <a href="booking.store">
                                <button type="button" class="btn btn-primary" data-dismiss="modal"
                                    onclick="window.location.href='/StatusBooking'">Done</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <!-- success Popup html End -->
            </div>
        </div>
    </div>
@endsection
