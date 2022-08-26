@extends('layouts.MasterView')
@section('menu_booking', 'active')
@section('content')
	{{-- <div class="main-container"> --}}
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Menu Edit Booking</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Edit Booking</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>

				<div class="pd-20 card-white mb-30">
					<div class="clearfix">
						<h4 class="text-blue h4">Edit Data Booking</h4>
						{{-- <p class="mb-30">jQuery Step wizard</p> --}}
					</div>
					<div class="wizard-content">
						<form class="tab-wizard wizard-circle wizard">
							<h5>Data Pengirim</h5>
							<section>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label >Nama Pengirim :</label>
											<input type="text" class="form-control">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label >No.Telp Pengirim :</label>
											<input type="text" class="form-control">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Email Pengirim :</label>
											<input type="email" class="form-control">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Status booking :</label>
											<input type="text" class="form-control">
										</div>
									</div>
								</div>
							</section>
							<!-- Step 2 -->
							<h5>Jadwal</h5>
							<section>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Pilih Container :</label>
											<select class="custom-select form-control">
												<option value="">Select City</option>
												<option value="Amsterdam">India</option>
												<option value="Berlin">UK</option>
												<option value="Frankfurt">US</option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label >Pilih Jadwal :</label>
											<input type="text" class="form-control date-picker" placeholder="Select Date">
										</div>
									</div>
								</div>
							</section>
							<!-- Step 3 -->
							<h5>Data Barang</h5>
							<section>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Nama Barang :</label>
											<input type="text" class="form-control">
										</div>
										<div class="form-group">
											<label>Jumlah barang :</label>
											<input type="text" class="form-control">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Berat Barang (Kg) :</label>
											<input type="text" class="form-control">
										</div>
										<div class="form-group">
											<label>Requirement :</label>
											<input type="text" class="form-control">
										</div>
									</div>
								</div>
							</section>
							<!-- Step 4 -->
							<h5>Data Penerima</h5>
							<section>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Nama Penerima :</label>
											<input type="text" class="form-control">
										</div>
										<div class="form-group">
											<label>Alamat Penerima :</label>
											<input type="text" class="form-control">
										</div>
										<div class="form-group">
											<label>No.Telp Penerima :</label>
											<input type="text" class="form-control">
										</div>
                                        <div class="form-group">
											<label>Email Penerima :</label>
											<input type="email" class="form-control">
										</div>
									</div>
								</div>
							</section>
						</form>
					</div>
				</div>

				<!-- success Popup html Start -->
				<div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-body text-center font-18">
								<h3 class="mb-20">Form Submitted!</h3>
								<div class="mb-30 text-center"><img src="vendors/images/success.png"></div>
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							</div>
							<div class="modal-footer justify-content-center">
								<button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
							</div>
						</div>
					</div>
				</div>
				<!-- success Popup html End -->
			</div>
		</div>
	{{-- </div> --}}
@endsection
