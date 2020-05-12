@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'login', 'title' => __('Material Dashboard')])

@section('content')
<style>
.input-custome{
  width: 100%;
  border: 2px solid black;
  border-radius: 20px;
  height:45px;
}
.btn-dark {
  width: 100%;
  border-radius: 25px;
  height: 45px;
  background: black !important;
  color:#76ebac !important;
  font-size: 16px;
  font-weight: bold;
}
</style>
<div class="container" style="height:auto">
  <div class="row align-items-center">
    <div class="col-lg-8 col-md-8 col-sm-8 ml-auto mr-auto">
      <form class="form" method="POST" action="{{ route('login') }}">
        @csrf

        <div class="card card-login card-hidden mb-3">
          <div class="card-body row px-0 py-0 mx-0" style="height:415px;">
            <div class="col-md-8 px-5 py-5" style="background:#76ebac;">
              <h2 class="font-weight-bold mb-4">Berkerja Extra Aperesiasi Pasti Terjamin Nyaman</h2>
              <div style="border-left: 3px solid black;" class="pl-3">
              <p class="font-weight-bold" style="font-size: 16px;">Apresisasi dan kompensasi yang terkelola dengan baik dan sistematis akan selalu hadir berperan menciptakan budaya Fun, Productive, Blessed</p>
              </div>
            </div>
            <div class="col-md-4 py-5">
            <p class="card-description text-center">Login with <strong>admin@goodpeople.com</strong> {{ __(' and the password ') }}<strong>secret</strong> </p>
            <div class="bmd-form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
              <div class="input-group">
                <label for="email" class="font-weight-bold" style="font-size:18px; color: black">Username</label>
                <input type="email" class="input-custome pl-3" name="email" id="email"  value="" required>
              </div>
              @if ($errors->has('email'))
                <div id="email-error" class="error text-danger pl-3" for="email" style="display: block; position:absolute; font-size:10px;">
                  <strong>{{ $errors->first('email') }}</strong>
                </div>
              @endif
            </div>
            <div class="bmd-form-group{{ $errors->has('password') ? ' has-danger' : '' }} mt-3">
              <div class="input-group">
                <label for="email" class="font-weight-bold" style="font-size:18px; color: black">Password</label> 
                <input type="password" name="password" id="password" class="input-custome pl-3" value="" required>
              </div>
              @if ($errors->has('password'))
                <div id="password-error" class="error text-danger pl-3" for="password" style="display: block; position:absolute; font-size:10px;">
                  <strong>{{ $errors->first('password') }}</strong>
                </div>
              @endif
            </div>
            <div class="text-center bmd-form-group{{ $errors->has('password') ? ' has-danger' : '' }} mt-3">
            <button type="submit" class="btn btn-primary btn-dark">Masuk</button>
            </div>
            <!-- <div class="form-check mr-auto ml-3 mt-3">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember me') }}
                <span class="form-check-sign">
                  <span class="check"></span>
                </span>
              </label>
            </div> -->
            </div>
          </div>
        </div>
      </form>
      <div class="row">
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
      </div>
    </div>
  </div>
</div>
@endsection
