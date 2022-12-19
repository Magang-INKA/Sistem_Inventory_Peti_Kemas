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
                                    <li class="breadcrumb-item active"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item" aria-current="page">Form Booking</li>
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
                                            <label for="select_pelabuhan_1">Pilih Asal Pelabuhan</label><br>
                                            <select id="select_pelabuhan1" name="pelabuhan1" data-placeholder="Select" class="custom-select w-100" required>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="select_pelabuhan_2">Pilih Tujuan Pelabuhan</label>
                                            <select id="select_pelabuhan2" name="pelabuhan2" data-placeholder="Select" class="custom-select w-100" required>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="select_jadwal" >Jadwal Kapal</label>
                                               <select id="select_jadwal" name="id_jadwal" data-placeholder="Select" class="custom-select w-100" required>
                                               </select>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!-- Step 2 -->
                            <h5>Data Barang</h5>
                            <section>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="nama_barang">Jenis Barang</label>
                                            <select class="form-control" id="jenis_barang" name="jenis_barang">
                                                @foreach ($jb as $jenisbarang)
                                                   <option value="{{ $jenisbarang->id }}">{{ $jenisbarang->jenis_barang }}</option>
                                                @endforeach
                                             </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_barang">Nama Barang :</label>
                                            <input type="text" class="form-control" name="nama_barang" id="nama_barang">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="berat">Berat(kg) :</label>
                                            <input type="number" class="form-control" name="berat_barang" id="berat">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Detail Dimensi Kemasan :</label>
                                            {{-- <input type="number" class="form-control" name="berat_barang" id="berat"> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="panjang">Panjang(cm) :</label>
                                            <input type="number" class="form-control" name="panjang" id="panjang">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="lebar">Lebar(cm) :</label>
                                            <input type="number" class="form-control" name="lebar" id="lebar">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tinggi">Tinggi(cm) :</label>
                                            <input type="number" class="form-control" name="tinggi" id="tinggi">
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
                                            <input type="text" class="form-control" name="nama_penerima">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="telp_penerima">Telephone Penerima :</label>
                                            <input type="text" class="form-control" name="telp_penerima">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="alamat">Alamat :</label>
                                            <input type="text" class="form-control" name="alamat_penerima">
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
    @push('javascript-internal')
  <script>
    $(document).ready(function() {

      $('#select_pelabuhan1').select2({
         allowClear: true,
         ajax: {
            url: "{{ route('pelabuhan1.select') }}",
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
               return {
                  results: $.map(data, function(item) {
                     return {
                        text: item.kode_pelabuhan + '-' +item.nama_pelabuhan,
                        id: item.kode_pelabuhan
                     }
                  })
               };
            }
         }
      });

$('#select_pelabuhan1').change(function() {
   //clear select
   $("#select_pelabuhan2").empty();
   $("#select_jadwal").empty();

   //set id
   let asalID = $('#select_pelabuhan1').val();
   if (asalID) {
      $('#select_pelabuhan2').select2({
         allowClear: true,
         ajax: {
            url: "{{ route('pelabuhan2.select') }}?asalID="+asalID,
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
               return {
                  results: $.map(data, function(item) {
                     return {
                        text: item.kode_pelabuhan+"-"+item.nama_pelabuhan,
                        id: item.kode_pelabuhan
                     }
                  })
               };
            }
         }
      });
   }
});

$('#select_pelabuhan2').change(function() {
   //clear select
   $("#select_jadwal").empty();

   //set id
   let tujuanID = $('#select_pelabuhan2').val();
   let asalID = $('#select_pelabuhan1').val();
   if (tujuanID) {
      $('#select_jadwal').select2({
         //var yay = "asalID='"+ asalID+"'&tujuanID='"+tujuanID+"'"
         allowClear: true,
         ajax: {
            url: "{{ route('jadwalkapal.select') }}?asalID="+asalID+"&"+"tujuanID="+tujuanID,
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
               return {
                  results: $.map(data, function(item) {
                     return {
                        text: item.id_trip+"|"+item.nama_kapal +"|"+ "ETA(Awal): " + item.ETA_awal +"|" +"ETD(Awal): " +item.ETD_awal+"|"+ "ETA(Tujuan): " + item.ETA_tujuan,
                        id: item.id
                     }
                  })
               };
            }
         }
      });
   }
});

// EVENT ON CLEAR
$('#select_pelabuhan1').on('select2:clear', function(e) {
   $("#select_pelabuhan2").select2();
   $("#select_jadwal").select2();
});

$('#select_pelabuhan2').on('select2:clear', function(e) {
   $("#select_jadwal").select2();
});
});


    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
      // This function will display the specified tab of the form...
      var x = document.getElementsByClassName("tab");
      x[n].style.display = "block";
      //... and fix the Previous/Next buttons:
      if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
      } else {
        document.getElementById("prevBtn").style.display = "inline";
      }
      if (n == (x.length - 1)) {
        document.getElementById("nextBtn").innerHTML = "Submit";
      } else {
        document.getElementById("nextBtn").innerHTML = "Next";
      }
      //... and run a function that will display the correct step indicator:
      fixStepIndicator(n)
    }

    function nextPrev(n) {
      // This function will figure out which tab to display
      var x = document.getElementsByClassName("tab");
      // Exit the function if any field in the current tab is invalid:
      if (n == 1 && !validateForm()) return false;
      // Hide the current tab:
      x[currentTab].style.display = "none";
      // Increase or decrease the current tab by 1:
      currentTab = currentTab + n;
      // if you have reached the end of the form...
      if (currentTab >= x.length) {
        // ... the form gets submitted:
        document.getElementById("regForm").submit();
        return false;
      }
      // Otherwise, display the correct tab:
      showTab(currentTab);
    }

    function validateForm() {
      // This function deals with validation of the form fields
      var x, y, i, valid = true;
      x = document.getElementsByClassName("tab");
      y = x[currentTab].getElementsByTagName("input");
      // A loop that checks every input field in the current tab:
      for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value == "") {
          // add an "invalid" class to the field:
          y[i].className += " invalid";
          // and set the current valid status to false
          valid = false;
        }
      }
      // If the valid status is true, mark the step as finished and valid:
      if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
      }
      return valid; // return the valid status
    }

    function fixStepIndicator(n) {
      // This function removes the "active" class of all steps...
      var i, x = document.getElementsByClassName("step");
      for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
      }
      //... and adds the "active" class on the current step:
      x[n].className += " active";
    }
    </script>
    @endpush

@endsection
