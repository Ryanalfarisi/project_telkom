@extends('layouts.app', ['activePage' => 'request-lembur', 'titlePage' => __('Request Overtime')])

@section('content')
@include('layouts.partials.head', array('extra'=> false, 'super' => $super, 'jabatan' => $user->jabatan, 'all_notif'=> $all_notif))
<style>
  .table-profile > tbody > tr >td {
    width:290px;
    padding:10px 0px;
  }
  .color-th {
    background: #D7D6FF;
    font-size:18px;
    font-weight: bold;
  }
  .btn-profile {
    background: #000000;
    border: 2px solid #000000;
    box-sizing: border-box;
    border-radius: 29px;
    width: 160px;
    height: 34px;
    padding: 5px 10px;
    color: #32EAAC;
    font-weight: bold;
    text-align: center;
  }
  #content_change {
    display: none;
  }
  #content_edit {
    display: none;
  }
  .bullet-process {
  width:10px;
  height:10px;
  display:inline-block;
  background: #35339D;
  border-radius:50%;
}
</style>
<div class="col-md-12">
  <ol class="breadcrumb d-inline-block">
    <li><a href="{{ route('home')}}" class="cl-orange fs-20">Home</a></li>
    <li class="active fs-20">Profile</li>
  </ol>
  <div class="col-md-12">
    @if (session('status'))
      <div class="fs-14 error text-success">{{ session('status') }}</div>
    @endif
  </div>
  <div class="col-md-8">
    <table class="table-profile">
      <tr>
        <td class="font-weight-bold fs-16">Nama / NIK</td>
      <td class="fs-15">{{$user->full_name}} / {{$user->nik}}</td>
      </tr>
      <tr>
        <td class="font-weight-bold fs-16">Jabatan / Band Posisi</td>
      <td class="fs-15">{{$user->jabatan}} / {{$user->grade}}</td>
      </tr>
      <tr>
        <td class="font-weight-bold fs-16">Lokasi Dinas / Unit</td>
      <td class="fs-15">{{$user->lokasi ?:'-'}} / {{$user->unit ?: '-'}}</td>
      </tr>
      @if (!$super)
      <tr>
        <td class="font-weight-bold fs-16">Total Points</td>
        <td class="fs-15">{{$user->poin}}</td>
      </tr>
      <tr>
        <td class="font-weight-bold fs-16">Achievement</td>
        <td class="fs-15">
          @for ($i = 0; $i < round($ach); $i++)
            <div class="bullet-process mr-3"></div>
          @endfor
          <b>({{$ach}})</b>
        </td>
      </tr>
      <tr>
        <td class="font-weight-bold fs-16">Rating</td>
        <td class="fs-15">
          @for ($i = 0; $i < round($rating); $i++)
            <img src="{{ asset('material') }}/img/star.png" alt="" width="20px">
          @endfor
          <b>({{$rating}})</b>
        </td>
      </tr>
      @endif
    </table>
  </div>
  <div class="col-md-4">
    <div class="btn-profile mb-5 pointer" id="editProfile">
      Edit Profile
    </div>
    <div class="btn-profile mt-5 pointer" id="changePass">
      Change password
    </div>
  </div>
  {{-- @if(!$super)
  <div class="col-md-12" style="margin-top:30px;">
    <h3>Table Akumulasi Points</h3>
    <table id="table_point" class="row-border">
      <thead>
          <tr>
              <th class="color-th">Lembur</th>
              <th class="color-th">Insert date</th>
              <th class="color-th">Type of work</th>
              <th class="color-th">Assigned By</th>
              <th class="color-th">Point</th>
          </tr>
      </thead>
      <tbody>
      @foreach ($lembur as $row)
        <tr>
          <td class="row-color">{{$row->description}}</td>
          <td class="row-color">{{$row->insert_date}}</td>
          <td class="row-color">{{$row->jobname}}</td>
          <td class="row-color">{{$row->app_name}}</td>
          <td class="row-color">{{$row->duration}} ({{$row->poin}})</td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
  @endif --}}
  <div class="col-md-12 py-5" id="content_change" style="border-top: 1px solid #76ebac;">
    <p class="fs-20 font-weight-bold">Change password</p>
    <small><i> Harap ingat password pengganti.</i></small>
    @if ($errors->any())
      @foreach ($errors->all() as $error)
          <div class="fs-12 error text-danger">{{$error}}</div>
      @endforeach
    @endif
      <form class="form" method="POST" action="{{ route('my-profile.changepass') }}">
        @csrf
        <div class="form-group row mt-5">
          <div class="col-md-6 text-left">
            <label for="current" class="font-weight-bold input-basic fs-14">Current Password</label>
            <input type="password" name="current" id="current" class="input-custome pl-3" placeholder="{{ __('Current password...') }}" required>
          </div>
        </div>
        <div class="form-group row mt-3">
          <div class="col-md-6 text-left">
            <label for="password" class="font-weight-bold input-basic">New Password</label> 
            <input type="password" name="password" id="password" class="input-custome pl-3" placeholder="{{ __('Password...') }}" required>
          </div>
        </div>
        <div class="form-group row mt-3">
          <div class="col-md-6 text-left">
            <label for="repassword" class="font-weight-bold input-basic">Re-type New Password</label> 
            <input type="password" name="repassword" id="repassword" class="input-custome pl-3" placeholder="{{ __('Re-type Password...') }}" required>
          </div>
        </div>
        <input type="hidden" name="userId" value="{{$user->id}}">
        <input type="hidden" name="username" value="{{$user->username}}">
        <button type="submit" class="btn-profile mb-5">
          Submit
        </button>
      </form>
  </div>
  <div class="col-md-12 py-5" id="content_edit" style="border-top: 1px solid #76ebac;">
    <p class="fs-20 font-weight-bold">Edit Profile</p>
    <small><i> Silahkan ganti profile anda.</i></small>
      <form class="form" method="POST" action="{{ route('my-profile.editprofile') }}">
        @csrf
        <div class="form-group row mt-5">
          <div class="col-md-4 text-left">
            <label for="username" class="font-weight-bold input-basic fs-14">Full name</label>
            <input value="{{$user->full_name}}" type="text" name="full_name" id="full_name" class="input-custome pl-3" placeholder="full name .." required>
          </div>
          <div class="col-md-3 text-left">
            <label for="username" class="font-weight-bold input-basic fs-14">NIK</label>
            <input value="{{$user->nik}}" readonly type="text" name="nik" id="nik" class="input-custome pl-3" placeholder="NIK.." required>
          </div>
        </div>
        <div class="form-group row mt-3">
          <div class="col-md-4 text-left">
            <label for="jabatan" class="font-weight-bold input-basic">Jabatan</label>
            <input value="{{$user->jabatan}}" type="text" name="jabatan" id="jabatan" class="input-custome pl-3" placeholder="Jabatan..." required>
          </div>
          <div class="col-md-3 text-left">
            <label for="email" class="font-weight-bold input-basic">Band</label>
            <select class="form-control" name="grade">
              @foreach ($grade as $item)
                <option value="{{$item}}"
                @if ($item == $user->grade)
                      selected="selected"
                @endif
                >{{$item}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group row mt-3">
          <div class="col-md-4 text-left">
            <label for="lokasi" class="font-weight-bold input-basic">Lokasi</label>
          <input value="{{$user->lokasi}}" type="text" name="lokasi" id="lokasi" class="input-custome pl-3" placeholder="Lokasi.." >
          </div>
          <div class="col-md-3 text-left">
            <label for="unit" class="font-weight-bold input-basic">Unit</label>
            <input value="{{$user->unit}}" type="text" name="unit" id="unit" class="input-custome pl-3" placeholder="Unit.." >
          </div>
        </div>
        <input type="hidden" name="userId" value="{{$user->id}}">
        <input type="hidden" name="username" value="{{$user->username}}">
        <button type="submit" class="btn-profile mb-5">
          Submit
        </button>
      </form>
  </div>
</div>
@endsection
@push('js')
  <script>
    $(document).ready(function() {
      $('#table_point').DataTable({
        "searching": false,
        "paging":   false,
      });
      $("#changePass").click(function() {
          $("#content_change").css('display', 'block');
          $("#content_edit").css('display', 'none');
      });
      $("#editProfile").click(function() {
        $("#content_edit").css('display', 'block');
        $("#content_change").css('display', 'none');
      });
    });
  </script>
@endpush