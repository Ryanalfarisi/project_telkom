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
      <form class="form" method="POST" action="{{ route('login') }}">
        @csrf

        <div class="card card-login card-hidden mb-3">
          <div class="card-body row px-0 py-0 mx-0"  style="height:600px;">
            <div class="col-md-8 wrapper-login">
              <h2 class="font-weight-bold mb-4">Bekerja Extra</h2>
              <h2 class="font-weight-bold mb-4"> Apresiasi Pasti</h2>
              <h2 class="font-weight-bold mb-4">Terjamin Nyaman</h2>
              <div style="border-left: 3px solid black;" class="pl-3">
                <p class="font-weight-bold mt-5" style="font-size: 16px;">Apresiasi dan kompensasi yang terkelola dengan baik dan sistematis akan selalu hadir berperan menciptakan budaya Fun, Productive, Blessed</p>
              </div>
            </div>
            <div class="col-md-4 text-center">
              <img src="{{ asset('material') }}/img/goodpeople.png" width="250px">
              <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                <div class="text-left">
                  <label for="username" class="font-weight-bold input-basic">Username</label>
                  <input type="text" class="input-custome pl-3" name="username" id="username"  value="" required>
                </div>
                @if ($errors->has('username'))
                  <div id="email-error" class="error text-danger pl-3" for="name" style="display: block; position:absolute; font-size:10px;">
                    <strong>{{ $errors->first('username') }}</strong>
                  </div>
                @endif
              </div>
              <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }} mt-3">
                <div class="text-left">
                  <label for="email" class="font-weight-bold input-basic">Password</label> 
                  <input type="password" name="password" id="password" class="input-custome pl-3" value="" required>
                </div>
                @if ($errors->has('password'))
                  <div id="password-error" class="error text-danger pl-3" for="password" style="display: block; position:absolute; font-size:10px;">
                    <strong>{{ $errors->first('password') }}</strong>
                  </div>
                @endif
              </div>
              @if (session('success'))
                <div class="fs-12 error text-success">{{ session('success') }}</div>
              @endif
              <div class="mt-5 col-md-12 px-0" style="border-bottom: 1px solid rgba(0, 0, 0, 0.1);">
                <div class="col-md-6 px-0 text-left">
                  <div class="form-check mr-auto ml-3 mt-3">
                    <label class="form-check-label" style="color:grey; font-weight:normal;">
                      <input class="form-check-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember me') }}
                      <span class="form-check-sign">
                        <span class="check"></span>
                      </span>
                    </label>
                  </div>
                </div>
                <div class="col-md-6 px-0 mb-5">
                  <button type="submit" class="btn btn-primary btn-dark">Masuk</button>
                </div>
                <div>
                    <a class="cl-green" href="{{ route('my-profile.reset') }}" >
                      {{ __('Forgot password?') }}
                    </a>
                </div>
              </div>
              <div class="col-md-12 px-0 mt-5">
                <p class="fs-18">Belum punya akun?</p>
                <a class="btn-register fs-20 px-5 py-2" href="{{ route('register') }}">
                  <small>{{ __('Daftar GoodPeople') }}</small>
                </a>
              </div>
            </div>
          </div>
        </div>
      </form>
      <!-- <div class="row">
        <div class="col-6">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-light">
                    <small>{{ __('Forgot password?') }}</small>
                </a>
            @endif
        </div>
        <div class="col-6 text-right">
            <a href="{{ route('register') }}" class="text-light">
                <small>{{ __('Create new account') }}</small>
            </a>
        </div>
      </div> -->
    </div>
</div>
@endsection
