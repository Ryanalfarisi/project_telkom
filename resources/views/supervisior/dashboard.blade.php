@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
<style>
* {
  -webkit-box-sizing:border-box;
  -moz-box-sizing:border-box;
  box-sizing:border-box;
}

*:before, *:after {
-webkit-box-sizing: border-box;
-moz-box-sizing: border-box;
box-sizing: border-box;
}

.clearfix {
  clear:both;
}

.text-center {text-align:center;}

/* a {
  color: tomato;
  text-decoration: none;
} */

a:hover {
  color: #2196f3;
}

pre {
display: block;
padding: 9.5px;
margin: 0 0 10px;
font-size: 13px;
line-height: 1.42857143;
color: #333;
word-break: break-all;
word-wrap: break-word;
background-color: #F5F5F5;
border: 1px solid #CCC;
border-radius: 4px;
}

.header {
  padding:20px 0;
  position:relative;
  margin-bottom:10px;
}

.header:after {
  content:"";
  display:block;
  height:1px;
  background:#eee;
  position:absolute;
  left:30%; right:30%;
}

.header h2 {
  font-size:3em;
  font-weight:300;
  margin-bottom:0.2em;
}

.header p {
  font-size:14px;
}



#a-footer {
  margin: 20px 0;
}

.new-react-version {
  padding: 20px 20px;
  border: 1px solid #eee;
  border-radius: 20px;
  box-shadow: 0 2px 12px 0 rgba(0,0,0,0.1);
  text-align: center;
  font-size: 14px;
  line-height: 1.7;
}

.new-react-version .react-svg-logo {
  text-align: center;
  max-width: 60px;
  margin: 20px auto;
  margin-top: 0;
}

.success-box {
  margin:20px 0;
  padding:10px 10px;
  border:1px solid #eee;
  background:#f9f9f9;
  display: none;
}

.success-box img {
  margin-right:10px;
  display:inline-block;
  vertical-align:top;
}

.success-box > div {
  vertical-align:top;
  display:inline-block;
  color:#888;
}



/* Rating Star Widgets Style */
.rating-stars ul {
  list-style-type:none;
  padding:0;
  -moz-user-select:none;
  -webkit-user-select:none;
}
.rating-stars ul > li.star {
  display:inline-block;
}

/* Idle State of the stars */
.rating-stars ul > li.star > i.fa {
  font-size:2.5em; /* Change the size of the stars */
  color:#ccc; /* Color on idle state */
}

/* Hover state of the stars */
.rating-stars ul > li.star.hover > i.fa {
  color:#FFCC36;
}

/* Selected state of the stars */
.rating-stars ul > li.star.selected > i.fa {
  color:#FF912C;
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
.bg-status-1 {
  background: #F3AF00;
  padding: 4px 5px;
  border-radius: 6px;
  font-size: 14px;
}
.bg-status-3, .bg-status-6 {
  background: #31EAAB;
  padding: 4px 5px;
  border-radius: 6px;
  font-size: 14px;
  border: none;
}
.bg-status-4 {
  background: #D80000;
  padding: 4px 5px;
  border-radius: 6px;
  font-size: 14px;
}
.bg-status-5 {
  background: #0023D8;
  padding: 4px 5px;
  border-radius: 6px;
  font-size: 14px;
  color: white;
}
.bg-status-7 {
  background: #FF7E07;
  padding: 4px 5px;
  border-radius: 6px;
  font-size: 14px;
}
.bg-status-inprogress {
  background: rgba(255, 0, 0, 0.5);
  padding: 4px 5px;
  border-radius: 6px;
  font-size: 14px;
}
#table_riwayat_filter {
  display: none !important;
}
</style>
  @include('layouts.partials.head', array('extra'=> false, 'super' => true, 'jabatan'=> $user->jabatan, 'all_notif' => $all_notif))
  <!-- Modal -->
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <form class="form" method="POST" action="{{ route('home.rating') }}">
          @csrf
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Rating & Feedback</h4>
          </div>
          <div class="modal-body">
            <header class='header text-center'>
              <h2>Rating & Feedback</h2>
              <p>Berikan penilaian anda atas kinerja staff <span id="staff_name"></span>
            </header>
              <section class='rating-widget'>
              <div class='rating-stars text-center'>
                <p>Achievement</p>
                <ul id='achievement'>
                  <li class='star' title='Poor' data-value='1'>
                    <i class='fa fa-star fa-fw'></i>
                  </li>
                  <li class='star' title='Fair' data-value='2'>
                    <i class='fa fa-star fa-fw'></i>
                  </li>
                  <li class='star' title='Good' data-value='3'>
                    <i class='fa fa-star fa-fw'></i>
                  </li>
                  <li class='star' title='Excellent' data-value='4'>
                    <i class='fa fa-star fa-fw'></i>
                  </li>
                  <li class='star' title='WOW!!!' data-value='5'>
                    <i class='fa fa-star fa-fw'></i>
                  </li>
                </ul>
              </div>
              <!-- Rating Stars Box -->
              <div class='rating-stars text-center'>
                <p>Rating</p>
                <ul id='stars'>
                  <li class='star' title='Poor' data-value='1'>
                    <i class='fa fa-star fa-fw'></i>
                  </li>
                  <li class='star' title='Fair' data-value='2'>
                    <i class='fa fa-star fa-fw'></i>
                  </li>
                  <li class='star' title='Good' data-value='3'>
                    <i class='fa fa-star fa-fw'></i>
                  </li>
                  <li class='star' title='Excellent' data-value='4'>
                    <i class='fa fa-star fa-fw'></i>
                  </li>
                  <li class='star' title='WOW!!!' data-value='5'>
                    <i class='fa fa-star fa-fw'></i>
                  </li>
                </ul>
              </div>
              <div class="text-center">
                <textarea name="feedback" style="height:70px; width:300px; margin:auto;" class="form-control" id="rating" cols="10" rows="5" placeholder="Give your feedback" required></textarea>
                <button type="submit" style="margin-top: 40px; width: 100px;height: 35px;color: white;font-size: 16px;" class="bg-status-3 text-white">Submit</button>
              </div>
              <div class='success-box'>
                <div class='clearfix'></div>
                <div>
                  <img alt='tick image' width='32' src='data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA0MjYuNjY3IDQyNi42NjciIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDQyNi42NjcgNDI2LjY2NzsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTJweCIgaGVpZ2h0PSI1MTJweCI+CjxwYXRoIHN0eWxlPSJmaWxsOiM2QUMyNTk7IiBkPSJNMjEzLjMzMywwQzk1LjUxOCwwLDAsOTUuNTE0LDAsMjEzLjMzM3M5NS41MTgsMjEzLjMzMywyMTMuMzMzLDIxMy4zMzMgIGMxMTcuODI4LDAsMjEzLjMzMy05NS41MTQsMjEzLjMzMy0yMTMuMzMzUzMzMS4xNTcsMCwyMTMuMzMzLDB6IE0xNzQuMTk5LDMyMi45MThsLTkzLjkzNS05My45MzFsMzEuMzA5LTMxLjMwOWw2Mi42MjYsNjIuNjIyICBsMTQwLjg5NC0xNDAuODk4bDMxLjMwOSwzMS4zMDlMMTc0LjE5OSwzMjIuOTE4eiIvPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K'/>
                </div>
                <div>
                  <div class='text-message'></div>
                  <div class='text-message-ach'></div>
                </div>
                <div class='clearfix'></div>
              </div>
              </section>
          </div>
          <input type="hidden" name="rating" value="">
          <input type="hidden" name="achievement" value="">
          <input type="hidden" name="points" id="duration" value="">
          <input type="hidden" name="id" id="lembur_id" value="">
        </form>
      </div>

    </div>
  </div>
  <div class="col-md-12 mt-4 pl-5">
    <ul class="nav nav-tabs">
      <li class="active position-relative pointer" id="home_list">
        <a data-toggle="tab" onclick="openNotif({{$user->id}},'notif_todo')" class="list-menu" href="#home">To do
          @if ($todo)
            <div id="notif_todo" class="bullet-notif rounded-black d-inline-block align-middle ml-2">{{$todo}}</div>
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
      <li class="position-relative" id="riwayat_list">
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
        <a data-toggle="tab" class="list-menu" href="#todo">Request
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
                    <th class="color-th"></th>
                    <th class="color-th">Type of work</th>
                    <th class="color-th">Request By</th>
                    <th class="color-th">Challenge</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($lembur as $row)
              @if (
                  $row->type == '1' &&
                  (
                    $row->status == '3' && $row->time_until > date("Y-m-d H:i:s") || $row->status == '5'
                  )
                  )
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
                    @elseif($row->status == '3' && $row->time_from > date("Y-m-d H:i:s"))
                        <span class="bg-status-1">
                            <a class="text-dark pointer" onclick="where_open('tracking')">Queue</a>
                        </span>
                    @elseif($row->status == '3' && $row->time_until < date("Y-m-d H:i:s"))
                        <span class="bg-status-3">
                          <a class="text-dark pointer" onclick="where_open('tracking')">Finished</a>
                        </span>
                    @elseif($row->status == '3' && $row->time_until > date("Y-m-d H:i:s"))
                        <span class="bg-status-inprogress">
                          <a class="text-dark pointer" onclick="where_open('tracking')">In progress</a>
                        </span>
                    @endif
                  </td>
                  @if ($row->status == '3' && $row->time_from < date("Y-m-d H:i:s"))
                    <td class="row-color timer" data-id="{{$row->id}}" data-app-time="{{$row->time_from}}" data-duration="{{$row->duration}}">
                      <p>Sisa waktu <span id="timer-{{$row->id}}"></span></p>
                    </td>
                  @elseif($row->status == '3' && $row->time_from > date("Y-m-d H:i:s"))
                    <td class="row-color timer" data-id="{{$row->id}}" data-app-time="{{$row->time_from}}" data-duration="0" data-duration-helper="{{$row->duration}}">
                      <p>Mulai dalam <span id="timer-{{$row->id}}"></span></p>
                    </td>
                  @else
                    <td class="row-color">-</td>
                  @endif
                  <td class="row-color">{{$row->jobs_name}}</td>
                  <td class="row-color">{{$row->username}} <b>({{$row->user_nik}})</b></td>
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
                    {{-- <th class="color-th" style="width: 150px;"></th> --}}
                    <th class="color-th">Insert date</th>
                    <th class="color-th">Type of work</th>
                    <th class="color-th">Request By</th>
                    <th class="color-th">Challenge</th>
                    <th class="color-th">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($lembur as $row)
              @if ($row->type == '1' && $row->status == '3' && $row->time_until < date("Y-m-d H:i:s") && !$row->feedback)
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
                    @elseif ($row->status == '6')
                      <span class="text-dark bg-status-{{$row->status}}">{{$row->label}}<b> (Done)</b></span>
                    @endif
                  </td>
                  {{-- @if ($row->time_from < date("Y-m-d H:i:s"))
                    <td class="row-color timer" data-id="{{$row->id}}" data-app-time="{{$row->updated_at}}" data-duration="{{$row->duration}}">
                      <p>Sisa waktu <span id="timer-{{$row->id}}"></span></p>
                    </td>
                  @else
                    <td class="row-color timer" data-id="{{$row->id}}" data-app-time="{{$row->time_from}}" data-duration="0">
                      <p>Mulai dalam <span id="timer-{{$row->id}}"></span></p>
                    </td>
                  @endif --}}
                  <td class="row-color">{{$row->created_at}}</td>
                  <td class="row-color">{{$row->jobs_name}}</td>
                  <td class="row-color">{{$row->username}} <b>({{$row->code_jabatan}})</b></td>
                  <td class="row-color">{{$row->duration}} Extra hours</td>
                  <th class="row-color">
                    @if ($row->time_until < date("Y-m-d H:i:s") && !$row->feedback)
                      <span onclick="rating('{{$row->username}}', '{{$row->duration}}', '{{$row->id}}')" class="bg-status-1 pointer text-white" style="color: white;font-weight: normal;" data-toggle="modal" data-target="#myModal">Rating</span>
                    @endif
                  </th>
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
                    <th class="color-th">Request by</th>
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
                  <th class="color-th">Achivement</th>
                  <th class="color-th">Review</th>
                  <th class="color-th">Requester</th>
                  <th class="color-th"></th>
              </tr>
          </thead>
          <tbody>
          @foreach ($lembur as $row)
            @if ($row->status == '6' && $row->rating && $row->feedback)
              <tr>
                <td class="row-color">{{$row->description}}</td>
                <td class="row-color">
                  @for ($i = 0; $i < $row->achievement; $i++)
                    <div class="bullet-process mr-3"></div>
                  @endfor
                </td>
                <td class="row-color">
                  @for ($i = 0; $i < $row->rating; $i++)
                    <img src="{{ asset('material') }}/img/star.png" alt="" width="20px">
                  @endfor
                </td>
                <td class="row-color fs-16">{{$row->username}} <b>({{$row->code_jabatan}})</b></td>
                <td class="row-color fs-16">{{$row->feedback}}</td>
              </tr>
            @endif
          @endforeach
          </tbody>
        </table>
      </div>
      {{-- <div id="todo" class="tab-pane fade">
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
                  @elseif ($row->status == '6')
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
      </div> --}}
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
        duration_helper = $(el).attr('data-duration-helper');
        countdownTimeStart(row_id, app_time, duration, duration_helper);
      });

      var content = {!! json_encode($content) !!}
      activaTab(content);
      $('#table_tracking, #table_draf, #table_todo, #incoming_formulir').DataTable({
        "searching": false,
        "paging":   false,
      });
      $('#table_riwayat').DataTable({
        "paging":   false,
      });

       /* 1. Visualizing things on Hover - See next part for action on click */
      $('#stars li').on('mouseover', function(){
        var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
        // Now highlight all the stars that's not after the current hovered star
        $(this).parent().children('li.star').each(function(e){
          if (e < onStar) {
            $(this).addClass('hover');
          }
          else {
            $(this).removeClass('hover');
          }
        });
      }).on('mouseout', function(){
        $(this).parent().children('li.star').each(function(e){
          $(this).removeClass('hover');
        });
      });
      /* 2. Action to perform on click */
      $('#stars li').on('click', function(){
        var onStar = parseInt($(this).data('value'), 10); // The star currently selected
        var stars = $(this).parent().children('li.star');

        for (i = 0; i < stars.length; i++) {
          $(stars[i]).removeClass('selected');
        }
        for (i = 0; i < onStar; i++) {
          $(stars[i]).addClass('selected');
        }
        // JUST RESPONSE (Not needed)
        var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
        var msg = "";
        if (ratingValue > 1) {
            $("input[name='rating']").val(ratingValue);
            msg = "Thanks! You rated this " + ratingValue + " stars.";
        }
        else {
            msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
        }
        responseMessage(msg, 'rating');
      });

      $('#achievement li').on('click', function(){
        var onStar = parseInt($(this).data('value'), 10); // The star currently selected
        var stars = $(this).parent().children('li.star');

        for (i = 0; i < stars.length; i++) {
          $(stars[i]).removeClass('selected');
        }

        for (i = 0; i < onStar; i++) {
          $(stars[i]).addClass('selected');
        }

        // JUST RESPONSE (Not needed)
        var ratingValue = parseInt($('#achievement li.selected').last().data('value'), 10);
        var msg = "";
        if (ratingValue > 1) {
            $("input[name='achievement']").val(ratingValue);
            msg = "Thanks! You give " + ratingValue + " achievement  for this task.";
        }
        else {
            msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
        }
        responseMessage(msg, 'ach');
      });
    });
    function where_open(id) {
        $("#home").addClass("in active");
        $("#home_list").addClass("active");
        $("#riwayat, #todo").removeClass( "in active" );
        $("#riwayat_list").removeClass( "active" );
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
    function rating(username, duration, id) {
      var filter = duration.replace(":", ".");
      duration = parseFloat(filter)
      $("#staff_name").empty();
      $("#staff_name").append("<b>"+username+"</b>");
      $("#duration").val(duration);
      $("#lembur_id").val(id);
    }
    function activaTab(tab) {
      $('.nav-tabs a[href="#' + tab + '"]').tab('show');
    };
    function responseMessage(msg, type) {
      $('.success-box').css('display', 'block');
      if(type == 'ach') {
        $('.success-box div.text-message-ach').html("<span>" + msg + "</span>");

      }
      if(type == 'rating') {
        $('.success-box div.text-message').html("<span>" + msg + "</span>");
      }
    }
    function countdownTimeStart(row_id, app_time, duration, duration_helper = 0) {
        var countDownDate = new Date(app_time).getTime();
        var duration_time = duration;
        var timeParts = duration.split(":");
        var getDuration = (+timeParts[0] * (60000 * 60)) + (+timeParts[1] * 60000);
        var feature = countDownDate+getDuration;
        if(duration_time == '0') {
          feature = countDownDate;
        }
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
            if(duration == 0) {
              countdownTimeStart(row_id, app_time, duration_helper);
            } else {
              document.getElementById("timer-"+row_id).innerHTML = "Lembur Telah Selesai";
            }
        }
      }, 1000);
    }

    function openNotif(id, tabs) {
      var crsf = {!! json_encode(csrf_token()) !!}
      $.ajax({
        method: "POST",
        url: "/lembur/notification",
        data: {
          to_user_id: id,
          _token: crsf,
          }
      }).done(function( res ) {
        if(res.status == 200) {
          $("#"+tabs).attr("style", "display: none !important");
        }
      });
    }
  </script>
@endpush