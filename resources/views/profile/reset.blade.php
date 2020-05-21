@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'login', 'title' => __('Material Dashboard')])

@section('content')
<style>
.btn-dark {
  width: 100%;
  border-radius: 25px;
  height: 45px;
  background: black !important;
  color:#76ebac !important;
  font-size: 16px;
  font-weight: bold;
}
.btn-register {
  background: #FFFFFF;
  border: 2px solid #31EAAB;
  box-sizing: border-box;
  border-radius: 29px;
  color: black;
}
.wrapper-login {
  background:#76ebac;
  padding:100px 75px;
  height:100%;
}
</style>
<div class="container">
    <div class="col-lg-12 col-md-12 col-sm-12" style="margin-top:80px;">
      <form class="form" method="POST" action="{{ route('my-profile.doreset') }}">
        @csrf

        <div class="card card-login card-hidden mb-3">
          <div class="card-body row px-0 py-0 mx-0"  style="height:600px;">
            <div class="col-md-8 wrapper-login">
              <h2 class="font-weight-bold mb-4">Berkerja Extra</h2>
              <h2 class="font-weight-bold mb-4"> Aperesiasi Pasti</h2>
              <h2 class="font-weight-bold mb-4">Terjamin Nyaman</h2>
              <div style="border-left: 3px solid black;" class="pl-3">
                <p class="font-weight-bold mt-5" style="font-size: 16px;">Apresisasi dan kompensasi yang terkelola dengan baik dan sistematis akan selalu hadir berperan menciptakan budaya Fun, Productive, Blessed</p>
              </div>
            </div>
            <div class="col-md-4 text-center">
              <img src="{{ asset('material') }}/img/goodpeople.png" width="250px">
              <div class="form-group row">
                <div class="col-md-12 text-left">
                  <label for="username" class="font-weight-bold input-basic">Username</label>
                  <input type="text" name="username" class="input-custome pl-3" placeholder="{{ __('Username...') }}" value="" required>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-12 text-left">
                  <label for="email" class="font-weight-bold input-basic">Pertanyaan Keamanan</label>
                  <select class="form-control" name="ask">
                    @foreach ($ask as $item)
                      <option value="{{ $item->id}}">{{ $item->pertanyaan}}</option> 
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-12 text-left">
                  <label for="jawaban" class="font-weight-bold input-basic">Isi</label>
                  <input type="text" name="jawaban" id="jawaban" class="form-control" placeholder="{{ __('Isi...') }}" required>
                </div>
              </div>
              <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }} mt-3">
                <div class="text-left">
                  <label for="password" class="font-weight-bold input-basic">New Password</label> 
                  <input type="password" name="password" id="password" class="input-custome pl-3" placeholder="{{ __('Password...') }}" required>
                </div>
              </div>
              @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="fs-12 error text-danger">{{$error}}</div>
                @endforeach
              @endif
              @if (session('success'))
                <div class="fs-12 error text-success">{{ session('success') }}</div>
              @endif
              <div class="mt-5">
                <a href="{{ route ('login')}}" class="btn-register fs-20 px-5 py-2 mr-4">
                  Login
                </a>
                <button type="submit" class="btn-register fs-20 px-5 py-2">
                  <small>{{ __('Reset') }}</small>
                </button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
</div>
@endsection
