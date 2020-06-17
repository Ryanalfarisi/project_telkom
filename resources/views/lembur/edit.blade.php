@extends('layouts.app', ['activePage' => 'request-lembur', 'titlePage' => __('Request Overtime')])

@section('content')
@include('layouts.partials.head', array('extra'=> true, 'super'=> $super, 'jabatan' => $user->jabatan, 'all_notif' => $all_notif))
<style>
  .wrapper-staff {
    width: 100%;
    min-height: 400px;
    height:auto;
  }
  .cl-border-green {
    border: 2px solid #08C384;
    background: white;
  }
  .cl-border-yellow {
    border: 2px solid #F3AF00;
    background: white;
  }
  .cl-border-red {
    border: 2px solid #FD0101;
    background: white;
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
<div class="col-md-8 px-0">
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
  @if ($super)
    <ol class="breadcrumb d-inline-block">
      <li><a href="{{ route('home')}}" class="cl-orange fs-20">To Do</a></li>
      <li class="fs-20">Incoming</li>
      <li class="active fs-20">Follow up</li>
    </ol>
  @else
    <ol class="breadcrumb d-inline-block">
      <li><a href="{{ route('home')}}" class="cl-orange fs-20">Home</a></li>
      <li class="active fs-20">Formulir baru</li>
    </ol>
  @endif
  @if (session('success'))
    <div class="fs-14 px-5 error text-success">{{ session('success') }}</div>
  @endif
  <div class="wrapper-staff py-5 px-5">
      <form id="form_lembur" method="POST" action="{{ route('lembur.doedit') }}">
        <div id="modalApp" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title fs-14 font-weight-bold">Apakah anda sudah yakin?</h4>
              </div>
              <div class="modal-body pt-0">
                <div class="wrapper-choosen pt-2">
                    <span id="to_approve" class="fs-14 pointer cl-green font-weight-bold">Approve</span>
                    <span class="float-right pointer" data-dismiss="modal">Batal</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="modalReturn" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title fs-14 font-weight-bold">Apakah anda sudah yakin?
                    Tuliskan alasan anda
                </h4>
                <textarea name="reason" id="reason_return" cols="30" rows="5" class="form-control"></textarea>
              </div>
              <div class="modal-body pt-0">
                <div class="wrapper-choosen pt-2">
                    <span id="to_return" class="fs-14 pointer cl-orange font-weight-bold">Return</span>
                    <span class="float-right pointer" data-dismiss="modal">Batal</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="modalReject" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title fs-14 font-weight-bold">Apakah anda sudah yakin?</h4>
              </div>
              <div class="modal-body pt-0">
                <div class="wrapper-choosen pt-2">
                    <span id="to_reject" class="fs-14 pointer cl-red font-weight-bold">Reject</span>
                    <span class="float-right pointer" data-dismiss="modal">Batal</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      @csrf
      <div class="form-group row">
        <label for="asigned" class="col-sm-4 col-form-label font-weight-bold">Assigned By <span class="cl-orange float-right">*</span></label>
        <div class="col-sm-8">
          <select name="assigned" class="form-control-plaintext fs-style assigned" required>
            <option></option>
            @foreach ($assigned as $item)
              <option value="{{$item->id}}">{{$item->username}} <b>({{$item->jabatan}})</b></option>
            @endforeach
          </select>
        </div>
      </div>
        <div class="form-group row">
          <label for="activity" class="col-sm-4 col-form-label font-weight-bold">Detail Activity <span class="cl-orange float-right">*</span></label>
          <div class="col-sm-8 position-relative" id="activity_counter">
            <input type="text" name="activity[0]" class="form-control-plaintext input-staff" value="{{$lembur->description}}" placeholder="Deskripsi tugas secara singkat dan padat" required>
            @if ($super)
              <span class="fs-26 position-absolute text-secondary add-act pointer">+</span>
            @else
              <span class="fs-26 position-absolute text-secondary add-act pointer" onclick="addRow()">+</span>
            @endif
          </div>
        </div>
        <div class="form-group row">
          <label for="jobs" class="col-sm-4 col-form-label font-weight-bold">Type Of Work <span class="cl-orange float-right">*</span></label>
          <div class="col-sm-8">
          <select name="job" class="form-control-plaintext fs-style fs-14" id="job" required>
              <option value="">Pilih kategori Aktivitas</option>
              @foreach ($jobs as $job)
                    <option value="{{$job->id}}" {{$lembur->job == $job->id ? 'selected' : ''}}>{{$job->jobs_name}}</option>
              @endforeach
          </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="date" class="col-sm-4 col-form-label font-weight-bold">Date  <span class="cl-orange float-right">*</span></label>
          <div class="col-sm-8">
            <div class='input-group date' id='datetimepicker2'>
                <input type='text' name="insert_date" id="currentData" value="{{$lembur->insert_date}}" class="form-control" placeholder="{{$lembur->insert_date}}" required/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
             </div>
             <small id="alert_date" class="text-danger fs-12"></small>
          </div>
        </div>
        <div class="form-group row">
          <label for="startTime" class="col-sm-4 col-form-label font-weight-bold">Start Time <span class="cl-orange float-right">*</span></label>
          <div class="col-sm-2 pr-0 my-auto">
            <input type="hidden" value="{{$lembur->time_from}}" name="startTimeFull">
            <div class='input-group date' id='startTime'>
                <input type='text' value="" name="startTime" class="form-control" placeholder="00:00" required />
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
                <input type='text' name="endTime" value="" class="form-control" placeholder="00:00" required/>
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
            <input type="text" readonly name="duration" class="form-control input-staff" style="height:30px;" id="duration" value="" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="location" class="col-sm-4 col-form-label font-weight-bold">Location</label>
          <div class="col-sm-8 position-relative">
            <select name="location" class="form-control-plaintext fs-style fs-14 select-am" id="job" required>
              <option value="">Pilih lokasi (opsional)</option>
              @foreach ($locations as $item)
                <option value="{{$item}}" {{$lembur->location == $item ? 'selected' : ''}}>{{$item}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="result" class="col-sm-4 col-form-label font-weight-bold">Result</label>
          <div class="col-sm-8">
            <input type="text" name="result" placeholder="Sebutkan target (opsional)" class="form-control-plaintext input-staff" style="height:30px;" value="{{$lembur->result}}">
          </div>
        </div>
        <div class="form-group row">
          <label for="kpi" class="col-sm-4 col-form-label font-weight-bold">KPI</label>
          <div class="col-sm-8">
            <input type="checkbox" id="kpi_checkbox" checked="{{$lembur->kpi ? true : false}}">
            <label for="kpi_checkbox" class="fs-12 cl-grey pointer" style="font-weight: normal;">Minimum</label>
            <input type="text" value="{{$lembur->kpi}}" name="kpi" id="kpi" class="form-control d-inline-block" onkeyup="handleChange(this);" style="width:80px; height:30px; border-radius:10px;" maxlength="3">
            <span>%</span>
          </div>
        </div>
        <input type="hidden" name="draft" id="is_draft" value="1">
        <input type="hidden" name="lembur_id" value="{{$lembur->id}}">
        <input type="hidden" name="is_overtime" id="is_overtime" value="0">
        <input type="hidden" name="user_id"  value="{{$lembur->user_id}}">
  </div>
  @if (!$super)
    <div class="col-md-12 text-center">
      <button type="submit" id="checkSubmitDraft" class="btn-send mx-5 checkSubmitDraft">Save</button>
      <button type="submit" id="checkSubmitSave" class="btn-send mx-5">Submit</button>
      <button id="shadowDraft" type="button" style="display: none;" data-toggle="modal" data-target="#modalDraft">Submit_shadow</button>
      <button id="shadowSubmit" type="button" style="display: none;" data-toggle="modal" data-target="#modalSubmit">Submit_shadow</button>
      <button type="button" data-toggle="modal" data-target="#modalCancel" class="btn-send mx-5">Cancel</button>
    </div>
  @endif
</div>

@if ($super)
  <div class="col-md-4 px-0 position-relative" style="height:500px;">
    <div class="position-absolute" style="width: 100%; height:250px; bottom:0;">

      {{-- Approve --}}
      <button type="submit" id="btn_app" class="cl-border-green col-md-3 mx-3 text-center cl-grey py-2 pointer">
        Approve
      </button>
      <button data-toggle="modal" data-target="#modalApp" style="display: none;" id="shadowApp"></button>
      {{-- End approve --}}
      {{-- Return --}}
      <button type="submit" id="btn_return" class="cl-border-yellow col-md-3 mx-3 text-center cl-grey py-2 pointer">
        Return
      </button>
      <button data-toggle="modal" data-target="#modalReturn" type="button" id="shadowReturn" style="display: none;"></button>
      {{-- end return --}}

      {{-- Reject --}}
      <button  type="submit" id="btn_reject" class="cl-border-red col-md-3 mx-3 text-center cl-grey py-2 pointer">
        Reject
      </button>
      <button data-toggle="modal" data-target="#modalReject" type="button" id="shadowReject" style="display: none;"></button>
      {{-- End reject --}}

      <div class="col-md-12" style="margin-top:125px;">
        <div style="display: block" id="wrapper_edit">
            <button type="button" onclick="cancelBlock()" style="border-radius:20px;" class="bg-status-1 edit-btn px-5 font-weight-bold fs-16">Edit</button>
          <br>
          <span class="fs-12"><i>* Edit untuk merubah sebelum melakukan approve, return dan reject</i></span>
        </div>
        <div style="display: none;" id="wrapper_save">
          <button type="button" data-toggle="modal" data-target="#modalSubmit" style="border-radius:20px;background: #19E9DC;margin-right:20px;" class="bg-status-1 edit-btn px-5 font-weight-bold fs-16 checkSubmitDraft">Save</button>
          <button type="button" onclick="cancelNone()" style="border-radius:20px;background: white; border: 2px solid rgba(0, 0, 0, 0.25);" class="bg-status-1 edit-btn px-5 font-weight-bold fs-16">Cancel</button>
        </div>
      </div>
    </div>
  </div>
  <input type="hidden" name="super_user" value="{{$super}}">
  <input type="hidden" name="status_lembur" id="status_lembur" value="">
@endif
</form>
@endsection
@push('js')
  <script>
    $(document).ready(function() {
      var super_user = {!! json_encode($super) !!}
      if(super_user) {
        $('#form_lembur input').attr('readonly', 'readonly');

      }
      $("#kpi").inputFilter(function(value) {
        return /^\d*$/.test(value);    // Allow digits only, using a RegExp
      });

      var timeStart = $("input[name='startTimeFull']").val();
      var dateNow = formatYMD();
      if(timeStart < dateNow) {
        $("#alert_date").append('Waktu tidak valid, waktu mulai lembur telah terlewati ' +timeStart)
      }
      function formatYMD() {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();
        var hh = String(today.getHours()).padStart(2, '0');
        var mi = String(today.getMinutes()).padStart(2, '0');
        var ss = String(today.getSeconds()).padStart(2, '0');

        today = yyyy + '-' + mm + '-' + dd +' '+ hh + ':' + mi + ':' + ss;
        return today;
      }
      var shadow = 'shadowSubmit';
      $("#form_lembur").submit(function(e) {
        $("#"+shadow).click();
        event.preventDefault();
      });
      $(".checkSubmitDraft").click(function() {
          shadow = 'shadowDraft';
      });
      $("#checkSubmitSave").click(function() {
          shadow = 'shadowSubmit';
      });

      //Supervisior
      $("#btn_return").click(function() {
          shadow = 'shadowReturn';
      });
      $("#btn_reject").click(function() {
          shadow = 'shadowReject';
      });

      $("#btn_app").click(function() {
          shadow = 'shadowApp';
      });


      $("#to_draft").click(function() {
        $("#is_draft").val('0');
        var start_lembur_date = $("input[name='insert_date']").val()+ ' '+ $("input[name='startTime']").val();
        var date_now = moment().format("YYYY-MM-DD HH:mm");
        if($("#duration").val() == '00:00') {
          alert("Duration tidak valid");
        } else if(start_lembur_date <= date_now) {
          alert("Waktu tidak valid, Waktu lembur telah terlewati");
        } else {
          $("#form_lembur").submit();
        }
      });
      $("#to_submit").click(function() {
        currentData = $('#currentData').val();
        var start_timing = $("input[name='startTime']").val();
        $("#is_draft").val('1');
        if($("#duration").val() == '00:00') {
          alert("Duration tidak valid");
        } else if( (timeStart < dateNow) && (currentData+' '+start_timing < dateNow) ) {
          alert("Waktu tidak valid, waktu mulai lembur telah terlewati "+timeStart)
        } else {
          $("#form_lembur").submit();
        }
      });
      $("#to_cancel").click(function() {
        window.location.href = "/home"
      });

      $("#to_approve").click(function() {
        $("#status_lembur").val("3");
        if(timeStart < dateNow) {
          alert("Waktu tidak valid, waktu mulai lembur telah terlewati "+timeStart)
        } else {
          $("#form_lembur").submit();
        }
      });

      $("#to_return").click(function() {
        $("#status_lembur").val("7");
        var reason_return = $("#reason_return").val();
        if(reason_return.trim() != '' ) {
          $("#form_lembur").submit();
        } else {
          alert("alasan tidak boleh kosong")
        }
      });
      $("#to_reject").click(function() {
        $("#status_lembur").val("4");
        $("#form_lembur").submit();
      });

      $('#kpi_checkbox').change(function () {
        if($(this).prop("checked")) {
          $("#kpi").prop("readonly", false);
        } else {
          $("#kpi").prop("readonly", true);
          $("#kpi").val(0);
        }
      });
      $('#datetimepicker2').datetimepicker({
        format: 'YYYY-MM-DD',
        // minDate:new Date(),
        minDate:new Date(new Date().getTime() - 86400000*7)
      });
      var start_date_time = {!! json_encode($lembur->time_from) !!}
      var to_date_time = {!! json_encode($lembur->time_until) !!}
      $('#startTime').datetimepicker({
        format: 'HH:mm',
        date: start_date_time,
        enabledHours:[0,1,2,3,4,5,6,7,18,19,20,21,22,23]
      });
      $('#endTime').datetimepicker({
        format: 'HH:mm',
        date: to_date_time,
        enabledHours:[0,1,2,3,4,5,6,7,18,19,20,21,22,23]
      });

      var approveId = {!! json_encode($lembur->approved_id) !!}
      $('.assigned').val(approveId);
      $('.assigned').select2({
        placeholder: "Cari nama atasan",
        allowClear: true
      });
    });
    $('#startTime, #endTime').on('dp.change', function(e) {
        var start = $("input[name='startTime']").val();
        var end = $("input[name='endTime']").val();
        if(start && end) {
          convertUTC = moment(end).format('HH:mm');
          end = convertUTC == "Invalid date" ? end : convertUTC;
          var time = moment.utc(moment(end,"HH:mm").diff(moment(start,"HH:mm"))).format("HH:mm");
          $("#duration").val(time);
          if(end < start) {
            $("#is_overtime").val("1");
          } else {
            $("#is_overtime").val("0");
          }
        }
    })
    function addRow() {
      var counter = $("#activity_counter").find(':input');
      var html = `<input type="text" name="activity[`+counter.length+`]" class="form-control-plaintext input-staff" value="" placeholder="`+(counter.length +1) +`. . .">`;
      $("#activity_counter").append(html);
    }
    function openGoogleMap()
    {
      newWindow = window.open("/googlemaps", "gmaps", "status=0,scrollbars=1,width=800,height=500,left=200,top=100", 0)
    }
    function cancelNone()
    {
      $('#form_lembur input').attr('readonly', 'readonly');
      $("#wrapper_edit").css('display', 'block');
      $("#wrapper_save").css('display', 'none');
    }
    function cancelBlock()
    {
      $('#form_lembur input:not(#duration)').attr('readonly', false);
      $("#wrapper_edit").css('display', 'none');
      $("#wrapper_save").css('display', 'block');
    }
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