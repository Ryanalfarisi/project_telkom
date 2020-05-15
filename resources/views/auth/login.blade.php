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
.input-basic {
  font-size:18px;
  color: black;
}
</style>
<div class="container" style="height:auto">
  <div class="row align-items-center">
    <div class="col-lg-10 col-md-10 col-sm-10 ml-auto mr-auto px-0" style="margin-top:150px;">
    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div> -->
      <form class="form" method="POST" action="{{ route('login') }}">
        @csrf

        <div class="card card-login card-hidden mb-3">
          <div class="card-body row px-0 py-0 mx-0" style="height:420px;">
            <div class="col-md-8" style="background:#76ebac; padding:80px 120px;">
              <h2 class="font-weight-bold mb-4">Berkerja Extra Aperesiasi Pasti Terjamin Nyaman</h2>
              <div style="border-left: 3px solid black;" class="pl-3">
              <p class="font-weight-bold" style="font-size: 16px;">Apresisasi dan kompensasi yang terkelola dengan baik dan sistematis akan selalu hadir berperan menciptakan budaya Fun, Productive, Blessed</p>
              </div>
            </div>
            <div class="col-md-4">
            <img class="text-center" src="{{ asset('material') }}/img/goodpeople.png" width="250px">
            </img>
            <div class="bmd-form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
              <div class="input-group">
                <label for="email" class="font-weight-bold input-basic">Username</label>
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
                <label for="email" class="font-weight-bold input-basic">Password</label> 
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
</div>
@endsection
