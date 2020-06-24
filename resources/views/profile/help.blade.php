@extends('layouts.app', ['activePage' => 'request-lembur', 'titlePage' => __('Request Overtime')])

@section('content')
@include('layouts.partials.head', array('extra'=> false, 'super' => $super, 'jabatan' => $user->jabatan, 'all_notif'=> $all_notif))
<style>
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
</style>
<div class="col-md-12">
  <div class="col-md-12">
    @if (session('status'))
      <div class="fs-14 error text-success">{{ session('status') }}</div>
    @endif
  </div>
  <div class="col-md-12 py-4" id="content_change" style="border-top: 1px solid #76ebac;">
    <p class="fs-20 font-weight-bold mb-0">Help center</p>
    <small><i> Anda dapat memberi masukan, kritik ataupun saran untuk peningkatan kwalitas layanan</i></small>
    @if ($errors->any())
      @foreach ($errors->all() as $error)
          <div class="fs-12 error text-danger">{{$error}}</div>
      @endforeach
    @endif
    <form class="form mt-5" method="POST" action="{{route('my-profile.savehelp')}}">
        @csrf
        <div class="col-lg-4 col-md-4 col-4 px-0">
          <label for="email" class="fs-14 input-basic">Jenis laporan</label>
          <select class="form-control" name="type" required>
            <option value="1">Kritik</option>
            <option value="2">Saran</option>
            <option value="3">Gangguan</option>
          </select>
          <textarea name="comment" style="" class="form-control w-100 my-5" id="rating" cols="20" rows="10" placeholder="write your idea.." required></textarea>
          <button type="submit" class="btn-profile">
            Submit
          </button>
        </div>
        <input type="hidden" name="userId" value="{{$user->id}}">
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