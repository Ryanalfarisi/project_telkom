@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
<style>
.border-top-rl-radius {
  border-top-left-radius: 15px !important;
  border-top-right-radius: 15px !important;
}
.link-primary {
  border-color: #31EAAB #31EAAB #fff !important;
  color:black;
  padding: .5rem 2rem !important;
}
.active {
  background-color: #31EAAB !important;
}
.wrapper-tab {
  width:100%;
  min-height:450px;
  border: 2px solid #31EAAB;
}
.btn-add {
  width:70px;
  height:70px;
}
.color-th {
  background: #D7D6FF;
}
.row-color {
  border-bottom: 1px solid #32EAAC;
}
.bullet-process {
  width:10px;
  height:10px;
  display:inline-block;
  background: #35339D;
  border-radius:50%;
}
.bullet-process-grey {
  width:10px;
  height:10px;
  display:inline-block;
  background: #C4C4C4;
  border-radius:50%;
}
.sign-btn-add {
  font-size: 40px;
  position: absolute;
  top: 6px;
  left: 0;
  right: 0;
  bottom: 0;
  margin: auto;
  color:black;
}
</style>
  @include('layouts.partials.head', array('extra'=> false))
  <div class="col-md-12 mt-4 pl-5">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="border-top-rl-radius link-primary nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Formulir</a>
        </li>
        <li class="nav-item">
          <a class="border-top-rl-radius link-primary nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Riwayat</a>
        </li>
        <li class="nav-item">
          <a class="border-top-rl-radius link-primary nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Inbox</a>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
          <div class="wrapper-tab bg-white text-center">
            <div style="width:300px;" class="mx-auto mt-5">
              <p style="font-size:32px; color: rgba(19, 17, 17, 0.62);">Formulir baru</p>
              <div class="rounded-circle btn-add bg-green-primary text-center position-relative m-auto pointer">
                  <a href="{{ route('lembur.request') }}" class="sign-btn-add">+</a>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
          <div class="wrapper-tab bg-white">
            <div>
            <table id="table_id" class="row-border">
              <thead>
                  <tr>
                      <th class="color-th">Aktivitas</th>
                      <th class="color-th">Status</th>
                      <th class="color-th">Review</th>
                      <th class="color-th">Superiors</th>
                  </tr>
              </thead>
              <tbody>
              @foreach ($lembur as $row)
                <tr>
                      <td class="row-color">{{$row->description}}</td>
                      <td class="row-color">
                          <div class="bullet-process mr-3"></div>
                          <div class="bullet-process mr-3"></div>
                          <div class="bullet-process mr-3"></div>
                      </td>
                      <td class="row-color">
                      <img src="{{ asset('material') }}/img/star.png" alt="" width="20px">
                      <img src="{{ asset('material') }}/img/star.png" alt="" width="20px">
                      <img src="{{ asset('material') }}/img/star.png" alt="" width="20px">
                      </td>
                      <td class="row-color">{{$row->approved_by}}</td>
                  </tr>
              @endforeach
              </tbody>
            </table>
                
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
          <div class="wrapper-tab bg-white">
            <p style="font-size:40px; color: rgba(19, 17, 17, 0.62);">Formulir baru</p>
          </div>
        </div>
      </div>
  </div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      var setting = false;
      $( ".wrapper-img" ).click(function() {
        if(!setting) {
          $(".profile-hover").css('display', 'block');
          setting = true;
        } else {
          $(".profile-hover").css('display', 'none');
          setting = false; 
        }
      });
      $('#table_id').DataTable({
        "searching": false,
        "paging":   false,
      });
    });
  </script>
@endpush