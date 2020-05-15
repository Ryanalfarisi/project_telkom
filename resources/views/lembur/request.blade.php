@extends('layouts.app', ['activePage' => 'request-lembur', 'titlePage' => __('Request Overtime')])

@section('content')
@include('layouts.partials.head', array('extra'=> false))
<style>
  .wrapper-staff {
    width: 100%;
    min-height: 400px;
    height:auto;
    border: 4px solid #4F4F4F;
    border-radius: 15%;
  }
  .border-green {
    border: 4px solid #08C384;
  }
  .input-staff {
    border-bottom: 1px solid rgba(0, 0, 0, 0.29);
  }
  .input-staff::placeholder {
    color: #8E7E7E;
    font-size: 12px;
  }
  .fs-style {
    color: #8E7E7E;
    font-size: 12px; 
  }
  .input-time {
    width: 15px;
    height:20px;
    outline: none;
    border: 1px solid grey;
    border-radius: 2px;
  }
  .select2-selection {
    border: none !important;
  }
</style>
<div class="col-md-6 px-5">
  <div class="ml-5 mb-3">
    <img class="d-inline-block align-middle mr-2" src="{{ asset('material') }}/img/time.png" alt="" width="35px"> 
    <p class="d-inline-block mb-0 align-middle font-weight-bold" style="font-size:20px; color:rgba(19, 17, 17, 0.62);">Staff</p>
  </div>
  <div class="wrapper-staff py-4 px-4">
      <form>
        <div class="form-group row">
          <label for="activity" class="col-sm-4 col-form-label font-weight-bold">Detail Activity <span class="cl-orange float-right">*</span></label>
          <div class="col-sm-8">
            <input type="text"  class="form-control-plaintext input-staff" id="activity" value="" placeholder="Deskripsi tugas secara singkat dan padat">
          </div>
        </div>
        <div class="form-group row">
          <label for="type" class="col-sm-4 col-form-label font-weight-bold">Type Of Work <span class="cl-orange float-right">*</span></label>
          <div class="col-sm-8">
          <select class="form-control-plaintext fs-style" id="type">
              <option>Pilih kategori Aktivitas</option>
              <option>Input data</option>
              <option>Kunjungan customer</option>
              <option>Maintenecee</option>
          </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="asigned" class="col-sm-4 col-form-label font-weight-bold">Assigned By <span class="cl-orange float-right">*</span></label>
          <div class="col-sm-8">
            <select class="form-control-plaintext fs-style assigned" id="type">
              <option></option>
              <option>Pak yanto</option>
              <option>Kemuning</option>
              <option>Carisca</option>
              <option>Evan</option>
          </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="startTime" class="col-sm-4 col-form-label font-weight-bold">Start Time <span class="cl-orange float-right">*</span></label>
          <div class="col-sm-3 pr-0 my-auto">
            <input type="number" class="d-inline-block input-time">
            <input type="number" class="d-inline-block input-time">
            :
            <input type="number" class="d-inline-block input-time">
            <input type="number" class="d-inline-block input-time">
          </div>
          <div class="col-sm-4 px-0">
            <label for="startTime" class="col-form-label font-weight-bold mr-2">End Time <span class="cl-orange float-right">*</span></label>
            <input type="number" class="d-inline-block input-time">
            <input type="number" class="d-inline-block input-time">
            :
            <input type="number" class="d-inline-block input-time">
            <input type="number" class="d-inline-block input-time">
          </div>
        </div>
        <div class="form-group row">
          <label for="duration" class="col-sm-4 col-form-label font-weight-bold">Duration</label>
          <div class="col-sm-3">
            <input type="text" class="form-control input-staff" style="height:30px;" id="duration" value="">
          </div>
        </div>
        <div class="form-group row">
          <label for="date" class="col-sm-4 col-form-label font-weight-bold">Date</label>
          <div class="col-sm-8">
            <!-- <input type="text" readonly class="form-control-plaintext input-staff" id="date" value=""> -->
            <div class='input-group date' id='datetimepicker2'>
                <input type='text' class="form-control" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
             </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="location" class="col-sm-4 col-form-label font-weight-bold">Location</label>
          <div class="col-sm-8">
            <input type="text" class="form-control-plaintext input-staff" id="location" value="">
          </div>
        </div>
      </form>
  </div>
</div>
<div class="col-md-6 px-5">
  <div class="ml-5 mb-3"> 
    <p class="d-inline-block mb-0 align-middle font-weight-bold" style="font-size:20px; color:#08C384;">Superior</p>
  </div>
  <div class="wrapper-staff py-4 px-4 border-green">
  </div>
<!-- <div class="ml-5 mb-3">
    
    <div class="wrapper-staff py-4 px-4 border-green">
    </div>
 </div> -->
</div>
@endsection
@push('js')
  <script>
    $(document).ready(function() {
      // function formatState (state) {
      //   if (!state.id) {
      //     return state.text;
      //   }
      //   var $state = $(
      //     '<span><img src="vendor/images/flags/' +  state.element.value.toLowerCase() + 
      // '.png" class="img-flag" /> ' + 
      //   state.text +     '</span>'
      // );
      // return $state;
      // };

// $(".js-example-templating").select2({
//   templateResult: formatState
// });
      $('#datetimepicker2').datetimepicker();
      $('.assigned').select2({
        placeholder: "Cari nama atasan",
        allowClear: true
      });
    });
  </script>
@endpush