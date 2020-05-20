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
.nav-tabs>li>a {
  border: 1px solid #32EAAC;
  border-top-left-radius: 15px;
  border-top-right-radius: 15px;
  margin: 0px;
}
.list-menu {
  padding: 7px 25px !important;
  color: black;
  font-weight:bold;
}
.nav-tabs>li.active>a {
  background:#31EAAB !important;
  color:black;
}
.nav-tabs>li>a:hover {
  background:#31EAAB !important;
  color:black;
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
.bottom-formulir {
  width: 128.21px;
  height: 28px;
  border: 1px solid rgba(0, 0, 0, 0.5);
  line-height:25px;
}
.list-menu-extra >li:nth-child(1) {
  border-bottom: 1px solid rgba(30, 250, 237, 0.2);
  font-weight:bold;
}
</style>
  @include('layouts.partials.head', array('extra'=> false))
  <div class="col-md-12 mt-4 pl-5">
  <ul class="nav nav-tabs">
    <li class="active position-relative">
      <a data-toggle="tab" class="list-menu" href="#home">Extra</a>
      <div class="extra-menu position-absolute">
        <ul class="list-menu-extra px-0 list-none py-4 text-center">
          <li class="py-1">Extra</li>
          <li class="py-1" style="color:#594C4C">Formulir Baru</li>
          <li class="py-1" style="color:#594C4C">Tracking</li>
          <li class="py-1" style="color:#594C4C">Draft</li>
        </ul>
      </div>
    </li>
    <li><a data-toggle="tab" class="list-menu" href="#menu1">Riwayat<div class="bullet-notif rounded-black d-inline-block align-middle ml-2">3</div></a></li>
    <li><a data-toggle="tab" class="list-menu" href="#menu2">To Do <div class="bullet-notif rounded-black d-inline-block align-middle ml-2">3</div></a></li>
  </ul>
  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <div class="wrapper-tab bg-white text-center">
        <div style="width:300px;" class="mx-auto mt-5">
          <p style="font-size:32px; color: rgba(19, 17, 17, 0.62);">Formulir baru</p>
          <div class="rounded-circle btn-add bg-green-primary text-center position-relative m-auto pointer">
              <a href="{{ route('lembur.request') }}" class="sign-btn-add">+</a>
          </div>
          <div class="bottom-formulir d-inline-block mr-5 mt-5 align-middle">DRAFT</div>
          <div class="bottom-formulir d-inline-block mt-5 align-middle">TRACKING</div>
        </div>
      </div>
    </div>
    <div id="menu1" class="tab-pane fade">
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
    <div id="menu2" class="tab-pane fade">
      <h3>Menu 2</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
    <div id="menu3" class="tab-pane fade">
      <h3>Menu 3</h3>
      <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
    </div>
  </div>
      <!-- <ul class="nav nav-tabs" id="myTab" role="tablist">
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
      </div> -->
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