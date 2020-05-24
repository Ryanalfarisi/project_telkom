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
.list-menu {
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
}
.row-color {
  border-bottom: 1px solid #32EAAC;
  font-family: 'Poppins', sans-serif;
  font-size:16px;
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
  @include('layouts.partials.head', array('extra'=> false))
  <div class="col-md-12 mt-4 pl-5">
    <ul class="nav nav-tabs">
      <li class="active position-relative">
        <a data-toggle="tab" class="list-menu" href="#home">Extra</a>
        <div class="extra-menu position-absolute">
          <ul class="list-menu-extra px-0 list-none py-4 text-center">
            <li class="py-1">Extra</li>
            <li class="py-1 grey-list" onclick="where_open('formulir')">Formulir Baru</li>
            <li class="py-1 grey-list" onclick="where_open('tracking')">Tracking</li>
            <li class="py-1 grey-list" onclick="where_open('draf')">Draft</li>
          </ul>
        </div>
      </li>
      <li><a data-toggle="tab" class="list-menu" href="#riwayat">Riwayat<div class="bullet-notif rounded-black d-inline-block align-middle ml-2">3</div></a></li>
      <li><a data-toggle="tab" class="list-menu" href="#todo">To Do <div class="bullet-notif rounded-black d-inline-block align-middle ml-2">3</div></a></li>
    </ul>
    <div class="tab-content">
      <div id="home" class="tab-pane fade in active">
        <div id="formulir">
          <div class="wrapper-tab bg-white text-center">
            <div style="width:300px;" class="mx-auto mt-5">
              <p style="font-size:32px; color: rgba(19, 17, 17, 0.62);">Formulir baru</p>
              <div class="rounded-circle btn-add bg-green-primary text-center position-relative m-auto pointer">
                  <a href="{{ route('lembur.request') }}" class="sign-btn-add">+</a>
              </div>
              <div class="bottom-formulir d-inline-block mr-5 mt-5 align-middle pointer" onclick="where_open('draf')">DRAFT</div>
              <div class="bottom-formulir d-inline-block mt-5 align-middle pointer" onclick="where_open('tracking')">TRACKING</div>
            </div>
          </div>
        </div>
        <div id="tracking">
          <table id="table_tracking" class="row-border">
            <thead>
                <tr>
                    <th class="color-th">Tracking Formulir</th>
                    <th class="color-th">Status</th>
                    <th class="color-th">Insert date</th>
                    <th class="color-th">Type of work</th>
                    <th class="color-th">Assigned By</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($lembur as $row)
              @if ($row->type == '1')
                <tr>
                  <td class="row-color">{{$row->description}}</td>
                  <td class="row-color">
                    @if ($row->status == '1')
                      <span class="text-dark bg-status-{{$row->status}}">{{$row->label}}</span>
                    @endif
                  </td>
                  <td class="row-color">{{$row->insert_date}}</td>
                  <td class="row-color">{{$row->jobs_name}}</td>
                  <td class="row-color">{{$row->username}} <b>({{$row->code_jabatan}})</b></td>
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
                    <th class="color-th">Assign by</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($lembur as $row)
              @if ($row->type == '0')
                <tr>
                  <td class="row-color fs-16">{{$row->description}}</td>
                  <td class="row-color fs-16">
                      @if ($row->created_at)
                          <p>Created at : {{$row->created_at}}</p>
                      @else
                          <p>Last update :{{$row->updated_at}}</p>
                      @endif
                  </td>
                  <td class="row-color fs-16">
                      <p>{{$row->jobs_name}}</p>
                  </td>
                  <td class="row-color fs-16">{{$row->username}} <b>({{$row->code_jabatan}})</b></td>
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
                  <th class="color-th">Tracking formulir</th>
                  <th class="color-th">Status</th>
                  <th class="color-th">Review</th>
                  <th class="color-th">Superiors</th>
              </tr>
          </thead>
          <tbody>
          @foreach ($lembur as $row)
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
                  <td class="row-color">{{$row->approved_id}}</td>
              </tr>
          @endforeach
          </tbody>
        </table>
      </div>
      <div id="todo" class="tab-pane fade">
        <table id="table_todo" class="row-border">
          <thead>
              <tr>
                  <th class="color-th">Aktivitas</th>
                  <th class="color-th">Superiors</th>
                  <th class="color-th">Status</th>
                  <th></th>
                  <th class="color-th">Challenge</th>
              </tr>
          </thead>
          <tbody>
          @foreach ($lembur as $row)
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
                  <td class="row-color">{{$row->approved_id}}</td>
              </tr>
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
      $('#table_riwayat').DataTable({
        "searching": false,
        "paging":   false,
      });

      $('#table_tracking').DataTable({
        "searching": false,
        "paging":   false,
      });

      $('#table_draf').DataTable({
        "searching": false,
        "paging":   false,
      });

      $('#table_todo').DataTable({
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
  </script>
@endpush