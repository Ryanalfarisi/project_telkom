<style>
  .wrapper-img {
  height:90px;
  width:90px;
  border: 2px solid #8E7E7E;
  border-radius:50%;
}
.wrapper-img img {
  width: 100%;
  height: 100%;
  border-radius: 50%;
  cursor: pointer;
}
.profile-hover {
  display:none;
  list-style: none;
  padding: 0;
  background: rgb(51,60,57);
  background: linear-gradient(187deg, rgba(51,60,57,1) 0%, rgba(2,21,15,1) 19%, rgba(8,195,132,1) 100%);
  width: 170px;
  left: -43px;
  border-radius: 22px;
  padding: 0px 18px;
  font-size: 14px;
  color:white;
  font-style: italic;
  z-index:1;
  /* top:84px; */
  top:100px;
}
.profile-hover li {
  padding:5px 0px;
  border-bottom: 1px solid #1EFAED;
}

.profile-hover li:nth-last-child(1) {
  text-align:center;
  font-style:normal;
  font-weight:bold;
}
/* .wrapper-img img:hover + .profile-hover {
  display: block !important;
} */
/* .profile-hover:hover {
  display: block !important;
} */
</style>
<div style="margin-top:45px;">
  <div class="col-md-6 pl-5" style="height:auto;padding:20px;">
    <h2 class="font-weight-bold">GoodPeople</h2>
  </div>
  <div class="col-md-6 pr-5" style="height:auto; padding:20px;">
    <div class="wrapper-img pointer float-right position-relative">
      <img class="" src="{{ asset('material') }}/img/bagus.jpeg" alt="">
      <ul class="position-absolute profile-hover">
        <li><a style="color:white !important;" href="{{ route('home.my_profile') }}">Profile</a></li>
        <li>Change Password</li>
        <li>Switch Account</li>
        <li>Help</li>
        <li> <a href="{{ route('logout') }}" style="color:black;" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Keluar') }}</a></li>
    </ul>
    </div>
  </div>
</div>
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
    });
  </script>
@endpush