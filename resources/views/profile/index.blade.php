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
</style>
<div class="col-md-12">
  <ol class="breadcrumb">
    <li><a href="{{ route('home')}}" class="cl-orange fs-20">Home</a></li>
    <li class="active fs-20">Profile</li>
  </ol>
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
        <td class="fs-15">Kota Medan / Consumer Marketing</td>
      </tr>
    </table>
  </div>
  <div class="col-md-4">
    <div class="btn-profile mb-5">
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
</div>
@endsection
@push('js')
  <script>
    $(document).ready(function() {
  //     if ( $( "div" ).first().is( ":hidden" ) ) {
  //   $( "div" ).slideDown( "slow" );
  // } else {
  //   $( "div" ).hide();
  // }
//   $( "#changePass" ).click(function() {
//   $( "#content_change" ).slideDown( "slow", function() {
//     // Animation complete.
//   });
// });
// $( "#changePass" ).click(function() {
//   $( "#content_change" ).slideToggle( "slow" );
// });
      var open = false;
      $( "#changePass" ).click(function() {
        if(!open) {
          $( "#content_change").css('display', 'block');
            open = true
        } else {
          $("#content_change").css('display', 'none');
          open = false;
        }
      });
    });
  </script>
@endpush