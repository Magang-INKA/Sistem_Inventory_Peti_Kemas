@extends('layouts.MasterView')
@section('menu_user', 'active')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Booking</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('booking.index') }}">User</a></li>
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
	<form method="POST" action="{{ route('booking.store') }}" id="myForm" enctype="multipart/form-data">
        @csrf

      <div class="form-group row">
			<label for="role" class="col-sm-12 col-md-2 col-form-label text-white">Asal Pelabuhan</label>
            <div class="col-sm-12 col-md-10">
               <select id="select_pelabuhan1" name="pelabuhan1" data-placeholder="Select" class="custom-select w-100">
               </select>
            </div>
		</div>
      <div class="form-group row">
			<label for="role" class="col-sm-12 col-md-2 col-form-label text-white">Tujuan pelabuhan</label>
            <div class="col-sm-12 col-md-10">
               <select id="select_pelabuhan2" name="pelabuhan2" data-placeholder="Select" class="custom-select w-100">
               </select>
            </div>
		</div>
      <div class="form-group row">
			<label for="role" class="col-sm-12 col-md-2 col-form-label text-white">Jadwal Kapal</label>
            <div class="col-sm-12 col-md-10">
               <select id="select_jadwal" name="id_jadwal" data-placeholder="Select" class="custom-select w-100">
               </select>
            </div>
		</div>

		<div class="form-group row">
			<label class="col-sm-2 col-form-label"></label>
			<div class="col-sm-10">
				<button type="submit" class="btn btn-primary">Submit</button>
				<button type="reset" class="btn btn-danger">Reset</button>
                <div class="pull-right">
                    <a href="{{route('user.index')}}" type="button" class="btn" data-bgcolor="#3b5998" data-color="#ffffff">
                        <i class="icon-copy fa fa-arrow-left" aria-hidden="true"></i>
                        Kembali
                    </a>
                </div>
			</div>
		</div>
	</form>
</div>
<!-- Default Basic Forms End -->
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
                        text: item.id_trip+"|"+item.nama_kapal +"|"+ "ETA: " + item.ETA +"|" +"ETD: " +item.ETD,
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
