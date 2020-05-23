@extends('layouts.app', ['activePage' => 'request-lembur', 'titlePage' => __('Request Overtime')])

@section('content')
@include('layouts.partials.head', array('extra'=> false))
<style>
  .wrapper-staff {
    width: 100%;
    min-height: 400px;
    height:auto;
  }
  .border-green {
    border: 4px solid #08C384;
  }
  .input-staff {
    border-bottom: 1px solid rgba(0, 0, 0, 0.29);
    font-size:14px;
    color: #8E7E7E;
  }
  .select2-selection__rendered {
    border-bottom: 1px solid #8E7E7E;
  }
  .input-staff::placeholder {
    color: #8E7E7E;
    font-size: 12px;
  }
  .fs-style {
    color: #8E7E7E;
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
  .select2 > .select2-container {
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
  .add-act {
    right: 16px;
    top: 0;
  }
</style>
<div class="col-md-8 px-5">
  <div class="wrapper-staff py-5 px-5">
      <form id="form_lembur" method="POST" action="{{ route('lembur.add') }}">
      @csrf
        <div class="form-group row">
          <label for="activity" class="col-sm-4 col-form-label font-weight-bold">Detail Activity <span class="cl-orange float-right">*</span></label>
          <div class="col-sm-8 position-relative" id="activity_counter">
            <input type="text" name="activity[0]" class="form-control-plaintext input-staff" value="" placeholder="Deskripsi tugas secara singkat dan padat" required>
            <span class="fs-26 position-absolute text-secondary add-act pointer" onclick="addRow()">+</span>
          </div>
        </div>
        <div class="form-group row">
          <label for="type" class="col-sm-4 col-form-label font-weight-bold">Type Of Work <span class="cl-orange float-right">*</span></label>
          <div class="col-sm-8">
          <select name="type" class="form-control-plaintext fs-style fs-14" id="type" required>
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
            <select name="assigned" class="form-control-plaintext fs-style assigned" required>
              <option></option>
              @foreach ($assigned as $item)
                <option value="{{$item->id}}">{{$item->username}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="startTime" class="col-sm-4 col-form-label font-weight-bold">Start Time <span class="cl-orange float-right">*</span></label>
          <div class="col-sm-2 pr-0 my-auto">
            <div class='input-group date' id='startTime'>
              <input type='text' name="startTime" class="form-control" placeholder="00:00" required />
              <span class="input-group-addon">
                  <span class="glyphicon glyphicon-time"></span>
              </span>
           </div>
          </div>
          <div class="col-sm-6 px-0 text-right">
            <div class="col-sm-8" style="line-height: 28px;">
              <label for="endTime" class="col-form-label font-weight-bold">- End Time <span class="cl-orange float-right">*</span></label>
            </div>
            <div class="col-md-4 pl-0">
              <div class='input-group date' id='endTime'>
                <input type='text' name="endTime" class="form-control" placeholder="00:00" required/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-time"></span>
                </span>
             </div>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="duration" class="col-sm-4 col-form-label font-weight-bold">Duration  <span class="cl-orange float-right">*</span></label>
          <div class="col-sm-3">
            <input type="text" readonly class="form-control input-staff" style="height:30px;" id="duration" value="" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="date" class="col-sm-4 col-form-label font-weight-bold">Date  <span class="cl-orange float-right">*</span></label>
          <div class="col-sm-8">
            <div class='input-group date' id='datetimepicker2'>
                <input type='text' name="insert_date" class="form-control" placeholder="Pilih tanggal"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
             </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="location" class="col-sm-4 col-form-label font-weight-bold">Location</label>
          <div class="col-sm-8">
            <input type="text" name="location" placeholder="Pilih lokasi (opsional)" class="form-control-plaintext input-staff" id="location" value="">
          </div>
        </div>
        <div class="form-group row">
          <label for="duration" class="col-sm-4 col-form-label font-weight-bold">Result</label>
          <div class="col-sm-8">
            <input type="text" name="result" placeholder="Sebutkan target (opsional)" class="form-control-plaintext input-staff" style="height:30px;" value="">
          </div>
        </div>
        <div class="form-group row">
          <label for="kpi" class="col-sm-4 col-form-label font-weight-bold">KPI</label>
          <div class="col-sm-8">
            <input type="checkbox" id="kpi_checkbox">
            <label for="kpi_checkbox" class="fs-12 cl-grey pointer" style="font-weight: normal;">Minimum</label>
            <input type="text" disabled name="kpi" id="kpi" class="form-control d-inline-block" style="width:80px; height:30px; border-radius:10px;">
          </div>
        </div>
  </div>
  <div class="">
    <button type="submit" class="btn-send">Send</button>
  </div>
</div>
</form>
@endsection
@push('js')
  <script>
    $(document).ready(function() {
      $('#kpi_checkbox').change(function () {
        if($(this).prop("checked")) {
          $("#kpi").prop("disabled", false);
        } else {
          $("#kpi").prop("disabled", true);
        }
      });
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
      $('#startTime, #endTime').on('dp.change', function(e) {
        var start = $("input[name='startTime']").val();
        var end = $("input[name='endTime']").val();
        if(start && end) {
          if(end < start) {
            alert("waktu tidak valid");
            $("#duration").val("");
          } else {
            var time = moment.utc(moment(end,"HH:mm").diff(moment(start,"HH:mm"))).format("HH:mm");
            $("#duration").val(time);
          }

        }
      })
      $('#datetimepicker2').datetimepicker({
        format: 'YYYY-MM-DD'
      });
      $('#startTime').datetimepicker({
        format: 'HH:mm'
      });
      $('#endTime').datetimepicker({
        format: 'HH:mm'
      });
      $('.assigned').select2({
        placeholder: "Cari nama atasan",
        allowClear: true
      });
    });
    function addRow() {
      var counter = $("#activity_counter").find(':input');
      var html = `<input type="text" name="activity[`+counter.length+`]" class="form-control-plaintext input-staff" value="" placeholder=". . .">`;
      $("#activity_counter").append(html);
    }
  </script>
@endpush