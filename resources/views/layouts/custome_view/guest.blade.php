<style>
.navbar-default .navbar-nav>.active>a {
    background: transparent;
}
.navbar-default .navbar-nav>.active>a:hover{
    background: transparent;
}
</style>
<nav class="navbar navbar-default bg-green-primary navbar-fixed-top" style="height:80px;">
<div class="container">
  <div class="container-fluid pt-4">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <!-- <a class="navbar-brand" href="#">Brand</a> -->
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav nav-menus text-dark">
            <li class="active"><a href="#">About Us <span class="sr-only">(current)</span></a></li>
            <li><a href="#">Help Centre</a></li>
            <li><a href="#">Service</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right nav-menus text-dark">
            <li><a href="{{ route('login') }}">SigIn</a></li>
            <li><a href="#">Sign Up</a></li>
        </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</div>
</nav>
    @yield('content')
</div>