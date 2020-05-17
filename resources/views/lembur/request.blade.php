@extends('layouts.app', ['activePage' => 'request-lembur', 'titlePage' => __('Request Overtime')])

@section('content')
@include('layouts.partials.head', array('extra'=> false))
<style>
  .wrapper-staff {
    width: 100%;
    min-height: 400px;
    height:auto;
    border: 4px solid #4F4F4F;
    border-radius: 78px;
  }
  .border-green {
    border: 4px solid #08C384;
  }
  .input-staff {
    border-bottom: 1px solid rgba(0, 0, 0, 0.29);
    font-size:14px;
    color: #8E7E7E;
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
  .select2 select2-container {
    width:100% !important;
  }
  .btn-send {
    background: #000000;
    border: 2px solid #000000;
    box-sizing: border-box;
    border-radius: 29px;
    color: #32EAAC;
    font-weight: bold;
    font-size: 16px;
    width: 83px;
    height: 39px;
  }
</style>
<div class="col-md-6 px-5">
  <div class="ml-5 mb-3">
    <img class="d-inline-block align-middle mr-2" src="{{ asset('material') }}/img/time.png" alt="" width="35px"> 
    <p class="d-inline-block mb-0 align-middle font-weight-bold" style="font-size:20px; color:rgba(19, 17, 17, 0.62);">Staff</p>
  </div>
  <div class="wrapper-staff py-5 px-5">
      <form method="POST" action="{{ route('lembur.add') }}">
      @csrf
        <div class="form-group row">
          <label for="activity" class="col-sm-4 col-form-label font-weight-bold">Detail Activity <span class="cl-orange float-right">*</span></label>
          <div class="col-sm-8">
            <input type="text" name="activity" class="form-control-plaintext input-staff" id="activity" value="" placeholder="Deskripsi tugas secara singkat dan padat" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="type" class="col-sm-4 col-form-label font-weight-bold">Type Of Work <span class="cl-orange float-right">*</span></label>
          <div class="col-sm-8">
          <select name="type" class="form-control-plaintext fs-style" id="type">
              <option value="">Pilih kategori Aktivitas</option>
              <option value="1">Pengolahan Data dan Pelaporan</option>
              <option value="2">Sales Operational</option>
              <option value="3">Teknis Operational</option>
          </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="asigned" class="col-sm-4 col-form-label font-weight-bold">Assigned By <span class="cl-orange float-right">*</span></label>
          <div class="col-sm-8">
            <select name="assigned" class="form-control-plaintext fs-style assigned" id="assigned">
              <option></option>
              <option>OSM CM</option>
              <option>MGE SPP</option>
              <option>DEVP Marketing</option>
              <option>CEAM</option>
              <option>MGR CA</option>
              <option>MGR Sekdiv</option>
          </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="startTime" class="col-sm-4 col-form-label font-weight-bold">Start Time <span class="cl-orange float-right">*</span></label>
          <div class="col-sm-3 pr-0 my-auto">
            <!-- <input type="number" max="1" name="startMi" class="d-inline-block input-time">
            <input type="number" max="1" class="d-inline-block input-time"> -->
            <input type="time" id="appt" name="startTime" min="00:00" max="23:59" required>
            <!-- :
            <input type="number" max="1" class="d-inline-block input-time">
            <input type="number" max="1" class="d-inline-block input-time"> -->
          </div>
          <div class="col-sm-4 px-0">
            <label for="startTime" class="col-form-label font-weight-bold mr-2">End Time <span class="cl-orange float-right">*</span></label>
            <input type="time" id="appt" name="endTime" min="00:00" max="23:59" required>
            <!-- <input type="number" max="1" class="d-inline-block input-time">
            <input type="number" max="1" class="d-inline-block input-time">
            :
            <input type="number" max="1" class="d-inline-block input-time">
            <input type="number" max="1" class="d-inline-block input-time"> -->
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
            <div class='input-group date' id='datetimepicker2'>
                <input type='text' name="insertDate" class="form-control" />
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
  </div>
</div>
<div class="col-md-6 px-5">
  <div class="ml-5 mb-3"> 
    <p class="d-inline-block mb-0 align-middle font-weight-bold" style="font-size:20px; color:#08C384;">Superior</p>
  </div>
  <div class="wrapper-staff py-4 px-4 border-green">
  </div>
</div>
<div class="">
  <button type="submit" class="btn-send">Send</button>

</div>
</form>
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