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
      <form class="form" method="POST" action="{{ route('register') }}">
        @csrf

        <div class="card card-login card-hidden mb-3">
          <div class="card-body row px-0 py-0 mx-0"  style="height:715px;">
            <div class="col-md-7 wrapper-login">
              <h2 class="font-weight-bold mb-4">Bekerja Extra</h2>
              <h2 class="font-weight-bold mb-4"> Apresiasi Pasti</h2>
              <h2 class="font-weight-bold mb-4">Terjamin Nyaman</h2>
              <div style="border-left: 3px solid black;" class="pl-3">
                <p class="font-weight-bold mt-5" style="font-size: 16px;">Apresiasi dan kompensasi yang terkelola dengan baik dan sistematis akan selalu hadir berperan menciptakan budaya Fun, Productive, Blessed</p>
              </div>
            </div>
            <div class="col-md-5 text-center">
              <img src="{{ asset('material') }}/img/goodpeople.png" width="250px">
              <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                <div class="text-left">
                  <label for="username" class="font-weight-bold input-basic">Username</label>
                  <input type="text" name="username" class="input-custome pl-3" placeholder="{{ __('Username...') }}" value="{{ old('name') }}" required>
                </div>
                @if ($errors->has('username'))
                  <div id="name-error" class="error text-danger pl-3" for="username" style="display: block;">
                    <strong>{{ $errors->first('username') }}</strong>
                  </div>
                @endif
              </div>
              <div class="form-group{{ $errors->has('nik') ? ' has-danger' : '' }}">
                <div class="text-left">
                  <label for="nik" class="font-weight-bold input-basic">NIK</label>
                  <input type="text" name="nik" id="nik" class="input-custome pl-3" placeholder="{{ __('NIK') }}" value="{{ old('nik') }}" maxlength="6" required>
                  @if (session('status'))
                    <div class="fs-12 error text-danger">{{ session('status') }}</div>
                  @endif
                </div>
                @if ($errors->has('nik'))
                  <div id="nik-error" class="error text-danger pl-3" for="nik" style="display: block;">
                    <strong>{{ $errors->first('nik') }}</strong>
                  </div>
                @endif
              </div>
              <div class="form-group{{ $errors->has('full_name') ? ' has-danger' : '' }}">
                <div class="text-left">
                  <label for="full_name" class="font-weight-bold input-basic">Full name</label>
                  <input type="text" name="full_name" id="full_name" class="input-custome pl-3" placeholder="Full name" value="" required>
                  @if (session('status'))
                    <div class="fs-12 error text-danger">{{ session('status') }}</div>
                  @endif
                </div>
                {{-- @if ($errors->has('nik'))
                  <div id="nik-error" class="error text-danger pl-3" for="nik" style="display: block;">
                    <strong>{{ $errors->first('full_name') }}</strong>
                  </div>
                @endif --}}
              </div>
              <div class="form-group row">
                <div class="col-md-8 text-left">
                  <label for="email" class="font-weight-bold input-basic">Pertanyaan Keamanan</label>
                  <select class="form-control" name="ask">
                    @foreach ($ask as $item)
                      <option value="{{ $item->id}}">{{ $item->pertanyaan}}</option> 
                    @endforeach
                  </select>
                </div>
                <div class="col-md-4">
                  <label for="jawaban" class="font-weight-bold input-basic">Isi</label>
                  <input type="text" name="jawaban" id="jawaban" class="form-control" placeholder="{{ __('Isi...') }}" required>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-3 text-left">
                  <label for="email" class="font-weight-bold input-basic">Band</label>
                  <select class="form-control" name="grade">
                    @foreach ($grade as $item)
                      <option value="{{$item}}">{{$item}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-9 text-left">
                  <label for="jabatan" class="font-weight-bold input-basic">Jabatan</label>
                  <input type="text" name="jabatan" id="jabatan" class="input-custome pl-3" placeholder="Jabatan">
                </div>
              </div>
              <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }} mt-3">
                <div class="text-left">
                  <label for="password" class="font-weight-bold input-basic">Password</label> 
                  <input type="password" name="password" id="password" class="input-custome pl-3" placeholder="{{ __('Password...') }}" required>
                </div>
                @if ($errors->has('password'))
                  <div id="password-error" class="error text-danger pl-3" for="password" style="display: block; position:absolute; font-size:10px;">
                    <strong>{{ $errors->first('password') }}</strong>
                  </div>
                @endif
              </div>
              <div class="form-group{{ $errors->has('password_confirmation') ? ' has-danger' : '' }} mt-3">
                <div class="text-left">
                  <label for="password_confirmation" class="font-weight-bold input-basic">Confirmation</label>  
                  <input type="password" name="password_confirmation" id="password_confirmation" class="input-custome pl-3" placeholder="{{ __('Confirm Password...') }}" required>
                </div>
                @if ($errors->has('password_confirmation'))
                  <div id="password_confirmation-error" class="error text-danger pl-3" for="password_confirmation" style="display: block;">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                  </div>
                @endif
              </div>
              <div class="mt-5 px-0 mb-5 text-center">
                <button type="submit" class="btn btn-primary btn-dark">Daftar</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
</div>
@endsection

@push('js')
<script>
  $(document).ready(function() {
      $("#nik").inputFilter(function(value) {
        return /^\d*$/.test(value);    // Allow digits only, using a RegExp
      });
  });
  (function($) {
  $.fn.inputFilter = function(inputFilter) {
    return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
      if (inputFilter(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      } else {
        this.value = "";
      }
    });
  };
}(jQuery));
</script>
@endpush