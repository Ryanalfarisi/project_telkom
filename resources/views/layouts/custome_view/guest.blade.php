<div class="row">
    <div class="col-md-12">
    <div class="container px-0">
    <nav class="navbar navbar-expand-lg navbar-light px-5 fixed-top" style="background:#31EAAB;">
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item mx-3 active">
                        <a class="nav-link font-weight-bold" href="#">About Us <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link font-weight-bold text-dark" href="#">Help Centre</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link font-weight-bold text-dark" href="#">Service</a>
                    </li>
                </ul>
                <div class="navbar-text">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item mx-3">
                            <a class="nav-link font-weight-bold text-dark" href="{{ route('login') }}">SigIn</a>
                        </li>
                        <li class="nav-item mx-3">
                            <a class="nav-link font-weight-bold text-dark" href="#">Sign Up</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
        
    </div>
  <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
    @yield('content')

</div>
