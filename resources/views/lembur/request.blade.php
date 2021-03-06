@extends('layouts.app', ['activePage' => 'request-lembur', 'titlePage' => __('Request Overtime')])

@section('content')
@include('layouts.partials.head', array('extra'=> true, 'super'=> false, 'jabatan' => $user->jabatan, 'all_notif'=> $all_notif))
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
    border-bottom: 1px solid #8E7E7E;
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
  .modal-dialog {
    width: 300px;
    height: 95px;
  }
  .modal-header {
      border:none;
  }
  .wrapper-choosen {
    width: 150px;
    margin: auto;
    border-top: 1px solid rgba(30, 250, 237, 0.25);
  }
</style>
<div class="col-md-9 px-5">
  <!-- Modal -->
<div id="modalDraft" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header text-center">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title fs-14 font-weight-bold">Apakah anda ingin menyimpan nya sebagai draft ?</h4>
      </div>
      <div class="modal-body pt-0">
        <div class="wrapper-choosen pt-2">
            <span class="fs-14 pointer" id="to_draft" style="color: #594C4C;">Ya, tentu</span> <span class="float-right pointer" style="color:#08C484; font-weight:500;" data-dismiss="modal">Batal</span>
        </div>
      </div>
    </div>
  </div>
</div>
{{-- End modal --}}
<!-- Modal -->
<div id="modalSubmit" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header text-center">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title fs-14 font-weight-bold">Apakah anda ingin submit formulir ini ?</h4>
      </div>
      <div class="modal-body pt-0">
        <div class="wrapper-choosen pt-2">
            <span class="fs-14 pointer" id="to_submit" style="color: #594C4C;">Ya, tentu</span> <span class="float-right pointer" style="color:#08C484; font-weight:500;" data-dismiss="modal">Batal</span>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- End modal --}}
<div id="modalCancel" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header text-center">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title fs-14 font-weight-bold">Perubahan belum tersimpan, apakah Anda yakin ingin keluar?</h4>
      </div>
      <div class="modal-body pt-0">
        <div class="wrapper-choosen pt-2">
            <span class="fs-14 pointer" id="to_cancel" style="color: #594C4C;">Ya, tentu</span> <span class="float-right pointer" style="color:#08C484; font-weight:500;" data-dismiss="modal">Batal</span>
            <p class="fs-14 pointer text-center mt-2" style="color: #594C4C;" id="to_draft">Simpan ke draft</p>
        </div>
      </div>
    </div>
  </div>
</div>
{{-- End modal --}}
  <ol class="breadcrumb d-inline-block">
    <li><a href="{{ route('home')}}" class="cl-orange fs-20">Home</a></li>
    <li class="active fs-20">Formulir baru</li>
  </ol>
  <div class="wrapper-staff py-5 px-5">
      <form id="form_lembur" method="POST" action="{{ route('lembur.add') }}">
      @csrf
      <div class="form-group row">
        <label for="asigned" class="col-sm-4 col-form-label font-weight-bold">Assigned By <span class="cl-orange float-right">*</span></label>
        <div class="col-sm-8">
          <select name="assigned" class="form-control-plaintext fs-style assigned" required>
            <option></option>
            @foreach ($assigned as $item)
              <option value="{{$item->id}}">{{$item->full_name ?: '-'}} <b>({{$item->jabatan}})</b></option>
            @endforeach
          </select>
        </div>
      </div>
        <div class="form-group row">
          <label for="activity" class="col-sm-4 col-form-label font-weight-bold">Detail Activity <span class="cl-orange float-right">*</span></label>
          <div class="col-sm-8 position-relative" id="activity_counter">
            <input type="text" name="activity[0]" class="form-control-plaintext input-staff" value="" placeholder="Deskripsi tugas secara singkat dan padat" required>
            <span class="fs-26 position-absolute text-secondary add-act pointer" onclick="addRow()">+</span>
            <span class="fs-26 position-absolute text-secondary add-act pointer" style="right: 40px !important;"onclick="removeRow()">-</span>
          </div>
        </div>
        <div class="form-group row">
          <label for="jobs" class="col-sm-4 col-form-label font-weight-bold">Type Of Work <span class="cl-orange float-right">*</span></label>
          <div class="col-sm-8">
          <select name="job" class="form-control-plaintext fs-style fs-14 select-am" id="job" required>
              <option value="">Pilih kategori Aktivitas</option>
              @foreach ($jobs as $job)
                <option value="{{$job->id}}">{{$job->jobs_name}}</option>
              @endforeach
          </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="date" class="col-sm-4 col-form-label font-weight-bold">Date  <span class="cl-orange float-right">*</span></label>
          <div class="col-sm-8">
            <div class='input-group date' id='datetimepicker2'>
                <input type='text' name="insert_date" class="form-control" placeholder="Pilih tanggal" required/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
             </div>
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
          <div class="col-sm-2">
            <input type="text" readonly name="duration" class="form-control input-staff" style="height:30px;" id="duration" value="" required>
          </div>
          <span style="line-height: 30px; color:#8E7E7E;" class="fs-12"><i>* Hour/Jam</i></span>
        </div>
        <div class="form-group row">
          <label for="location" class="col-sm-4 col-form-label font-weight-bold">Location</label>
          <div class="col-sm-8 position-relative">
            <select name="location" class="form-control-plaintext fs-style fs-14 select-am" id="job" required>
              <option value="">Pilih lokasi (opsional)</option>
              <option value="Office">Office</option>
              <option value="Home">Home</option>
              <option value="Home">Site</option>
              <option value="FWA">FWA</option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="result" data-toggle="tooltip" title="Hasil yang harus terpenuhi sasaran utama (goal)" class="col-sm-4 col-form-label font-weight-bold">Result<span class="glyphicon glyphicon-info-sign ml-1 pointer" style="vertical-align: top;" aria-hidden="true"></span></label>
          <div class="col-sm-8">
            <input type="text" name="result" placeholder="Contoh : PPT produktivitas SF beserta evaluasi teritori manajemen" class="form-control-plaintext input-staff" style="height:30px;" value="">
          </div>
        </div>
        <div class="form-group row">
          <label for="kpi" class="col-sm-4 col-form-label font-weight-bold" data-toggle="tooltip" title="KPI (i) besaran threshold hasil akhir yang diharapkan dan disepakati oleh atasan dan bawahan, centang bila kurang dari 100 %">KPI<span class="glyphicon glyphicon-info-sign ml-1 pointer" style="vertical-align: top;" aria-hidden="true"></span></label>
          <div class="col-sm-8">
            <input type="checkbox" id="kpi_checkbox">
            <label  for="kpi_checkbox" class="fs-12 cl-grey pointer" style="font-weight: normal;">Minimum</label>
            <input type="text" data-toggle="tooltip" disabled name="kpi" id="kpi" class="form-control d-inline-block" onkeyup="handleChange(this);" style="width:80px; height:30px; border-radius:10px;" maxlength="3">
            <span>%</span>
          </div>
        </div>
        <input type="hidden" name="draft" id="is_draft" value="1">
        <input type="hidden" name="is_overtime" id="is_overtime" value="0">
  </div>
  <div class="col-md-12 text-center">
    <button type="submit" id="checkSubmitDraft" class="btn-send mx-5">Save</button>
    <button type="submit" id="checkSubmitSave" class="btn-send mx-5">Submit</button>
    <button id="shadowDraft" type="button" style="display: none;" data-toggle="modal" data-target="#modalDraft">Submit_shadow</button>
    <button id="shadowSubmit" type="button" style="display: none;" data-toggle="modal" data-target="#modalSubmit">Submit_shadow</button>
    <button type="button" data-toggle="modal" data-target="#modalCancel" class="btn-send mx-5">Cancel</button>
  </div>
</div>
</form>
@endsection
@push('js')
  <script>
    $(document).ready(function() {
      var shadow = '';
      $("#form_lembur").submit(function(e) {
        $("#"+shadow).click();
        event.preventDefault();
      });
      $("#checkSubmitDraft").click(function() {
          shadow = 'shadowDraft';
      });
      $("#checkSubmitSave").click(function() {
          shadow = 'shadowSubmit';
      });

      $("#to_draft").click(function() {
        $("#is_draft").val('0');
        var start_lembur_date = $("input[name='insert_date']").val()+ ' '+ $("input[name='startTime']").val();
        var date_now = moment().format("YYYY-MM-DD HH:mm");
        if($("#duration").val() == '00:00') {
          alert("Duration tidak valid");
        } else if(start_lembur_date <= date_now) {
          alert("Waktu start lembur tidak valid");
        } else{
          $("#form_lembur").submit();
        }
      });
      $("#to_submit").click(function() {
        $("#is_draft").val('1');
        var start_lembur_date = $("input[name='insert_date']").val()+ ' '+ $("input[name='startTime']").val();
        var date_now = moment().format("YYYY-MM-DD HH:mm");
        if($("#duration").val() == '00:00') {
          alert("Duration tidak valid");
        } else if(start_lembur_date <= date_now) {
          alert("Waktu start lembur tidak valid");
        } else {
          $("#form_lembur").submit();
        }
      });
      $("#to_cancel").click(function() {
        window.location.href = "/home"
      });

      $('#kpi_checkbox').change(function () {
        if($(this).prop("checked")) {
          $("#kpi").prop("disabled", false);
        } else {
          $("#kpi").prop("disabled", true);
        }
      });
      $('#startTime, #endTime').on('dp.change', function(e) {
        var start = $("input[name='startTime']").val();
        var end = $("input[name='endTime']").val();
        if(start && end) {
          var time = moment.utc(moment(end,"HH:mm").diff(moment(start,"HH:mm"))).format("HH:mm");
          $("#duration").val(time);
          if(end < start) {
            $("#is_overtime").val("1");
          } else {
            $("#is_overtime").val("0");
          }
        }
      })
      $('#datetimepicker2').datetimepicker({
        format: 'YYYY-MM-DD',
        // minDate:new Date()
        minDate:new Date(new Date().getTime() - 86400000*7)
      });
      $('#startTime').datetimepicker({
        format: 'HH:mm',
        enabledHours:[0,1,2,3,4,5,6,7,18,19,20,21,22,23]
      });
      $('#endTime').datetimepicker({
        format: 'HH:mm',
        enabledHours:[0,1,2,3,4,5,6,7,18,19,20,21,22,23]
      });
      $('.assigned').select2({
        placeholder: "Cari nama atasan",
        allowClear: true
      });
      $("#kpi").inputFilter(function(value) {
        return /^\d*$/.test(value);    // Allow digits only, using a RegExp
      });
    });
    function addRow() {
      var counter = $("#activity_counter").find(':input');
      var html = `<input type="text" name="activity[`+counter.length+`]" class="form-control-plaintext input-staff" value="" placeholder="`+(counter.length +1) +`. . .">`;
      $("#activity_counter").append(html);
    }
    function removeRow() {
      var counter = $("#activity_counter").find(':input');
      var count_div = counter.length -1;
      if(count_div >= 1) {
        $("#activity_counter :last-child").remove();
      }
    }
    // function openGoogleMap()
    // {
    //   newWindow = window.open("/googlemaps", "gmaps", "status=0,scrollbars=1,width=800,height=500,left=200,top=100", 0)
    // }
    function handleChange(input) {
      if (input.value < 0) input.value = 0;
      if (input.value > 100) {
        alert("Maximal nilai KPI 100%")
        input.value = 100;
      }
    }
    (function($) {
    $.fn.inputFilter = function(inputFilter) {
      return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
        if (inputFilter(this.value)) {
          this.oldValue = this.value;
          this.oldSelectionStart = this.selectionStart;
          this.oldSelectionEnd = this.selectionEnd;
        } else if (this.hasOwnProperty("oldValue")) {
          this.value = this.oldValue;
          this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
        } else {
          this.value = "";
        }
      });
    };
  }(jQuery));
  </script>
@endpush