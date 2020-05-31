@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
<style>
.border-top-rl-radius {
  border-top-left-radius: 15px !important;
  border-top-right-radius: 15px !important;
}
.link-primary {
  border-color: #31EAAB #31EAAB #fff !important;
  color:black;
  padding: .5rem 2rem !important;
}
.nav-tabs>li>a {
  border: 1px solid #32EAAC;
  border-top-left-radius: 15px;
  border-top-right-radius: 15px;
  margin: 0px;
}
.list-menu .list-extra-riwayat{
  padding: 7px 25px !important;
  color: black;
  font-weight:bold;
}
.nav-tabs>li.active>a {
  background:#31EAAB !important;
  color:black;
}
.nav-tabs>li>a:hover {
  background:#31EAAB !important;
  color:black;
}
.wrapper-tab {
  width:100%;
  min-height:450px;
  border: 2px solid #31EAAB;
}
.btn-add {
  width:70px;
  height:70px;
}
.color-th {
  background: #D7D6FF;
  font-size:18px;
  font-weight: bold;
}
.bullet-process {
  width:10px;
  height:10px;
  display:inline-block;
  background: #35339D;
  border-radius:50%;
}
.bullet-process-grey {
  width:10px;
  height:10px;
  display:inline-block;
  background: #C4C4C4;
  border-radius:50%;
}
.sign-btn-add {
  font-size: 40px;
  position: absolute;
  top: 6px;
  left: 0;
  right: 0;
  bottom: 0;
  margin: auto;
  color:black;
}
.bottom-formulir {
  width: 128.21px;
  height: 28px;
  border: 1px solid rgba(0, 0, 0, 0.5);
  line-height:25px;
}
.list-menu-extra >li:nth-child(1) {
  border-bottom: 1px solid rgba(30, 250, 237, 0.2);
  font-weight:bold;
}
.grey-list {
  color:#594C4C !important;
}
.list-menu-extra > li {
  cursor:pointer;
}
.extra-menu {
  display:none;
  z-index: 1;
}
.extra-menu:hover {
  display: block;
}
.list-menu:hover + .extra-menu {
  display: block !important;
}
#formulir {
  display: block;
}
#tracking {
  display: none;
}
#draf {
  display: none;
}

</style>
  @include('layouts.partials.head', array('extra'=> false, 'super' => true))
  <div class="col-md-12 mt-4 pl-5">
    <ul class="nav nav-tabs">
      <li class="active position-relative">
        <a data-toggle="tab" class="list-menu" href="#home">To do
          @if ($todo)
            <div class="bullet-notif rounded-black d-inline-block align-middle ml-2">{{$todo}}</div>
          @endif
        </a>
        <div class="extra-menu position-absolute">
          <ul class="list-menu-extra px-0 list-none py-4 text-center">
            <li class="py-1">Extra</li>
            <li class="py-1 grey-list" onclick="where_open('formulir')">Incoming formulir</li>
            <li class="py-1 grey-list" onclick="where_open('tracking')">Tracking</li>
          </ul>
        </div>
      </li>
      <li class="position-relative">
        <a data-toggle="tab" class="list-menu" href="#riwayat">Riwayat</a>
        <div class="extra-menu position-absolute">
          <ul class="list-menu-extra px-0 list-none py-4 text-center">
            <li class="py-1">Staff</li>
            @foreach ($staff as $item)
              <li class="py-1 grey-list"><a href="#riwayat" data-toggle="tab">{{$item->username}}</a></li>
            @endforeach
          </ul>
        </div>
      </li>
      <li>
        <a data-toggle="tab" class="list-menu" href="#todo">Assign
          {{-- <div class="bullet-notif rounded-black d-inline-block align-middle ml-2">3</div> --}}
        </a>
      </li>
    </ul>
    <div class="tab-content">
      <div id="home" class="tab-pane fade in active">
        <div id="formulir">
          <table id="incoming_formulir" class="row-border">
            <thead>
                <tr>
                    <th class="color-th">Incoming Formulir</th>
                    <th class="color-th">Status</th>
                    <th class="color-th">Insert date</th>
                    <th class="color-th" style="width: 80px !important;"></th>
                    <th class="color-th">Type of work</th>
                    <th class="color-th">Request By</th>
                    <th class="color-th">Challenge</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($lembur as $row)
              @if ($row->type == '1')
                <tr>
                  <td class="row-color">{{$row->description}}</td>
                  <td class="row-color">
                    @if ($row->status == '5')
                      <span class="text-dark bg-status-{{$row->status}}">{{$row->label}}</span>
                    @elseif($row->status == '3')
                      <span class="text-dark bg-status-{{$row->status}}">{{$row->label}}</span>
                    @elseif($row->status == '7')
                      <span class="text-dark bg-status-{{$row->status}}">{{$row->label}}</span>
                    @elseif($row->status == '4')
                      <span class="text-dark bg-status-{{$row->status}}">{{$row->label}}</span>
                    @elseif($row->status == '1')
                      <span class="text-dark bg-status-{{$row->status}}">{{$row->label}}</span>
                    @endif
                  </td>
                  <td class="row-color">{{$row->created_at}}</td>
                  <td class="row-color">
                    @if ($row->status == '5')
                        <span class="bg-status-1">
                            <a class="text-dark" href="/lembur/request/{{$row->id}}">Follow up</a>
                        </span>
                    @elseif($row->status == '7')
                        <span class="text-dark bg-status-{{$row->status}}">{{$row->label}}</span>
                    @elseif($row->status == '4')
                        <span class="text-dark bg-status-{{$row->status}}">{{$row->label}}</span>
                    @else
                        <span class="bg-status-inprogress">
                            <a class="text-dark pointer" onclick="where_open('tracking')">In progress</a>
                        </span>
                    @endif
                  </td>
                  <td class="row-color">{{$row->jobs_name}}</td>
                  <td class="row-color">{{$row->username}} <b>({{$row->code_jabatan}})</b></td>
                  <td class="row-color">{{$row->duration}} Extra Hours</td>
                </tr>
              @endif
            @endforeach
            </tbody>
          </table>
        </div>
        <div id="tracking">
          <table id="table_tracking" class="row-border">
            <thead>
                <tr>
                    <th class="color-th">Tracking Aktivitas</th>
                    <th class="color-th">Status</th>
                    <th class="color-th" style="width: 150px;"></th>
                    <th class="color-th">Insert date</th>
                    <th class="color-th">Type of work</th>
                    <th class="color-th">Challenge</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($lembur as $row)
              @if ($row->type == '1' && $row->status == '3')
                <tr>
                  <td class="row-color">{{$row->description}}</td>
                  <td class="row-color">
                    @if ($row->status == '5')
                      <span class="text-dark bg-status-{{$row->status}}">{{$row->label}}</span>
                    @elseif($row->status == '3')
                      <span class="text-dark bg-status-{{$row->status}}">{{$row->label}}</span>
                    @elseif($row->status == '7')
                      <span class="text-dark bg-status-{{$row->status}}">{{$row->label}}</span>
                    @elseif($row->status == '4')
                      <span class="text-dark bg-status-{{$row->status}}">{{$row->label}}</span>
                    @elseif($row->status == '1')
                      <span class="text-dark bg-status-{{$row->status}}">{{$row->label}}</span>
                    @endif
                  </td>
                  @if ($row->time_from < date("Y-m-d H:i:s"))
                    <td class="row-color timer" data-id="{{$row->id}}" data-app-time="{{$row->updated_at}}" data-duration="{{$row->duration}}">
                      <p>Sisa waktu <span id="timer-{{$row->id}}"></span></p>
                    </td>
                  @else
                    <td class="row-color timer" data-id="{{$row->id}}" data-app-time="{{$row->time_from}}" data-duration="0">
                      <p>Mulai dalam <span id="timer-{{$row->id}}"></span></p>
                    </td>
                  @endif
                  <td class="row-color">{{$row->created_at}}</td>
                  <td class="row-color">{{$row->jobs_name}}</td>
                  <td class="row-color">{{$row->duration}} Extra hours</td>
                </tr>
              @endif
            @endforeach
            </tbody>
          </table>
        </div>
        <div id="draf">
          <table id="table_draf" class="row-border">
            <thead>
                <tr>
                    <th class="color-th">Draft formulir</th>
                    <th class="color-th">Status</th>
                    <th class="color-th">Type of work</th>
                    <th class="color-th">Assigned by</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($lembur as $row)
              @if ($row->type == '0')
                <tr onclick="toEditDraft({{$row->id}})" class="pointer">
                  <td class="row-color">{{$row->description}}</td>
                  <td class="row-color">
                      @if ($row->created_at)
                          <p>Created at : {{$row->created_at}}</p>
                      @endif
                      @if ($row->updated_at)
                          <p>Last update :{{$row->updated_at}}</p>
                      @endif
                  </td>
                  <td class="row-color">
                      <p>{{$row->jobs_name}}</p>
                  </td>
                  <td class="row-color">{{$row->username}} <b>({{$row->code_jabatan}})</b></td>
              </tr>
              @endif
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div id="riwayat" class="tab-pane fade">
        <table id="table_riwayat" class="row-border">
          <thead>
              <tr>
                  <th class="color-th">Aktivitas</th>
                  <th class="color-th">Status</th>
                  <th class="color-th">Review</th>
                  <th class="color-th">Superiors</th>
              </tr>
          </thead>
          <tbody>
          @foreach ($lembur as $row)
            @if ($row->status == '6')
              <tr>
                <td class="row-color">{{$row->description}}</td>
                <td class="row-color">
                    <div class="bullet-process mr-3"></div>
                    <div class="bullet-process mr-3"></div>
                    <div class="bullet-process mr-3"></div>
                </td>
                <td class="row-color">
                <img src="{{ asset('material') }}/img/star.png" alt="" width="20px">
                <img src="{{ asset('material') }}/img/star.png" alt="" width="20px">
                <img src="{{ asset('material') }}/img/star.png" alt="" width="20px">
                </td>
                <td class="row-color fs-16">{{$row->username}} <b>({{$row->code_jabatan}})</b></td>
              </tr>
            @endif
          @endforeach
          </tbody>
        </table>
      </div>
      <div id="todo" class="tab-pane fade">
        <table id="table_todo" class="row-border">
          <thead>
              <tr>
                  <th class="color-th">Tracking Aktivitas</th>
                  <th class="color-th">Status</th>
                  <th class="color-th">Insert date</th>
                  <th class="color-th">Type of work</th>
                  <th class="color-th">Assigned by</th>
              </tr>
          </thead>
          <tbody>
          @foreach ($lembur as $row)
            @if ($row->type == '1')
              <tr>
                <td class="row-color">{{$row->description}}</td>
                <td class="row-color">
                  @if ($row->status == '5')
                      <span class="text-dark bg-status-{{$row->status}}">{{$row->label}}</span>
                  @elseif($row->status == '3')
                    <span class="text-dark bg-status-{{$row->status}}">{{$row->label}}</span>
                  @elseif($row->status == '7')
                    <span class="text-dark bg-status-{{$row->status}}">{{$row->label}}</span>
                  @elseif($row->status == '4')
                    <span class="text-dark bg-status-{{$row->status}}">{{$row->label}}</span>
                  @elseif($row->status == '1')
                      <span class="text-dark bg-status-{{$row->status}}">{{$row->label}}</span>
                  @endif
                </td>
                <td class="row-color">{{$row->created_at}}</td>
                <td class="row-color">{{$row->jobs_name}}</td>
                <td class="row-color">{{$row->username}} <b>({{$row->code_jabatan}})</b></td>
              </tr>
            @endif
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      $( ".timer" ).each(function( i, el ) {
        row_id = $(el).attr('data-id');
        app_time = $(el).attr('data-app-time');
        duration = $(el).attr('data-duration');
        countdownTimeStart(row_id, app_time, duration);
      });

      var content = {!! json_encode($content) !!}
      activaTab(content);
      $('#table_tracking, #table_draf, #table_todo, #incoming_formulir, #table_riwayat').DataTable({
        "searching": false,
        "paging":   false,
      });
    });
    function where_open(id) {
        $("#home").addClass("in active");
        $("#riwayat, #todo").removeClass( "in active" );
        if(id == 'formulir') {
          $("#"+id).css('display', 'block');
          $("#tracking, #draf").css('display', 'none');
        } else if(id == 'tracking') {
          $("#"+id).css('display', 'block');
          $("#formulir, #draf").css('display', 'none');
        } else if(id == 'draf') {
          $("#"+id).css('display', 'block');
          $("#formulir, #tracking").css('display', 'none');
        }
    }
    function toEditDraft(id) {
      window.location.href = '/lembur/request/'+id;
    }
    function activaTab(tab) {
      $('.nav-tabs a[href="#' + tab + '"]').tab('show');
    };

function countdownTimeStart(row_id, app_time, duration){
    var countDownDate = new Date(app_time).getTime();
    var duration = duration;
    var timeParts = duration.split(":");
    var getDuration = (+timeParts[0] * (60000 * 60)) + (+timeParts[1] * 60000);
    var feature = countDownDate+getDuration;
    if(duration == '0') {
      feature = countDownDate;
    }
    //var countDownDate = new Date("Sep 25, 2025 15:00:00").getTime();
    // Update the count down every 1 second
    var x = setInterval(function() {

    // Get todays date and time
    var now = new Date().getTime();
    // Find the distance between now an the count down date
    //var distance = countDownDate - now;
    var distance = feature - now;
    // Time calculations for days, hours, minutes and seconds
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    // Output the result in an element with id="demo"
    document.getElementById("timer-"+row_id).innerHTML = hours + ":"
    + minutes + ":" + seconds + "";
    // If the count down is over, write some text
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("timer-"+row_id).innerHTML = "Lembur Telah Selesai";
    }
}, 1000);
}
  </script>
@endpush