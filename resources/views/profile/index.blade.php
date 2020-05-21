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
  }
</style>
<div class="col-md-12">
  <div class="col-md-8">
    <table class="table-profile">
      <tr>
        <td class="font-weight-bold fs-16">Nama / NIK</td>
      <td class="fs-15">{{$user->name}} / {{$user->nik}}</td>
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
    <div class="btn-profile mt-5">
      Change password
    </div>
  </div>
</div>
@endsection
@push('js')
  <script>
  </script>
@endpush