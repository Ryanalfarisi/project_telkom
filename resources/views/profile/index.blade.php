@extends('layouts.app', ['activePage' => 'request-lembur', 'titlePage' => __('Request Overtime')])

@section('content')
@include('layouts.partials.head', array('extra'=> false))
<style>
  .table-profile > tbody > tr >td {
    width:290px;
    padding:10px 0px;
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
  .breadcrumb > li + li:before {
    color: #000000;
    content: "> ";
    padding: 0 5px;
  }
  .breadcrumb {
    background: white !important;
  }
  .breadcrumb > .active {
    color:black;
  }
  .breadcrumb > li:hover {
    color: #FF7E07 !important;
  }
  #content_change {
    display: none;
  }
  #content_edit {
    display: none;
  }
</style>
<div class="col-md-12">
  <ol class="breadcrumb">
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
      <td class="fs-15">{{$user->username}} / {{$user->nik}}</td>
      </tr>
      <tr>
        <td class="font-weight-bold fs-16">Jabatan / Band Posisi</td>
      <td class="fs-15">{{$user->jabatan}} / {{$user->grade}}</td>
      </tr>
      <tr>
        <td class="font-weight-bold fs-16">Lokasi Dinas / Unit</td>
      <td class="fs-15">{{$user->lokasi ?:'-'}} / {{$user->unit ?: '-'}}</td>
      </tr>
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
    {{-- @if ($errors->any())
      @foreach ($errors->all() as $error)
          <div class="fs-12 error text-danger">{{$error}}</div>
      @endforeach
    @endif --}}
      <form class="form" method="POST" action="{{ route('my-profile.editprofile') }}">
        @csrf
        <div class="form-group row mt-5">
          <div class="col-md-4 text-left">
            <label for="username" class="font-weight-bold input-basic fs-14">Username</label>
            <input value="{{$user->username}}" readonly type="text" name="username" id="username" class="input-custome pl-3" placeholder="Username.." required>
          </div>
          <div class="col-md-3 text-left">
            <label for="username" class="font-weight-bold input-basic fs-14">NIK</label>
            <input value="{{$user->nik}}" type="text" name="nik" id="nik" class="input-custome pl-3" placeholder="NIK.." required>
          </div>
        </div>
        <div class="form-group row mt-3">
          <div class="col-md-4 text-left">
            <label for="jabatan" class="font-weight-bold input-basic">Jabatan</label>
            <select class="form-control" name="jabatan">
              @foreach ($jabatan as $item)
                <option value="{{$item->code_jabatan}}"
                  @if ($item->code_jabatan == $user->code_jabatan)
                      selected="selected"
                  @endif
                >{{ $item->jabatan}}</option>
              @endforeach
            </select>
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
          <input value="{{$user->lokasi}}" type="text" name="lokasi" id="lokasi" class="input-custome pl-3" placeholder="Lokasi.." required>
          </div>
          <div class="col-md-3 text-left">
            <label for="unit" class="font-weight-bold input-basic">Unit</label>
            <input value="{{$user->unit}}" type="text" name="unit" id="unit" class="input-custome pl-3" placeholder="Unit.." required>
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
      $("#changePass").click(function() {
        console.log("oke");
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