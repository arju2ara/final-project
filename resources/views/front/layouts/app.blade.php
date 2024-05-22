<!DOCTYPE html>
<html class="no-js" lang="en_AU" />
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Courier Management System</title>
	<meta name="description" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />

	<meta name="HandheldFriendly" content="True" />
	<meta name="pinterest" content="nopin" />

	<meta property="og:locale" content="en_AU" />
	<meta property="og:type" content="website" />
	<meta property="fb:admins" content="" />
	<meta property="fb:app_id" content="" />
	<meta property="og:site_name" content="" />
	<meta property="og:title" content="" />
	<meta property="og:description" content="" />
	<meta property="og:url" content="" />
	<meta property="og:image" content="" />
	<meta property="og:image:type" content="image/jpeg" />
	<meta property="og:image:width" content="" />
	<meta property="og:image:height" content="" />
	<meta property="og:image:alt" content="" />

	<meta name="twitter:title" content="" />
	<meta name="twitter:site" content="" />
	<meta name="twitter:description" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:image:alt" content="" />
	<meta name="twitter:card" content="summary_large_image" />
	

	<link rel="stylesheet" type="text/css" href="{{asset('front-assets/css/slick.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{asset('front-assets/css/slick-theme.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{asset('front-assets/css/video-js.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('front-assets/css/style.css')}}" />

	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;500&family=Raleway:ital,wght@0,400;0,600;0,800;1,200&family=Roboto+Condensed:wght@400;700&family=Roboto:wght@300;400;700;900&display=swap" rel="stylesheet">

	<!-- Fav Icon -->
	<link rel="shortcut icon" type="image/x-icon" href="#" />
</head>
<body data-instant-intensity="mousedown">

<div class="bg-light top-header">        
	<div class="container">
		<div class="row align-items-center py-3 d-none d-lg-flex justify-content-between">
			<div class="col-lg-4 logo">
				<a href="index.php" class="text-decoration-none">
					<span class="h1 text-uppercase text-primary bg-dark px-2">Courier</span>
					<span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Service</span>
				</a>
			</div>
			<div class="col-lg-6 col-6 text-left  d-flex justify-content-end align-items-center">
				
			</div>		
		</div>
	</div>
</div>

<header class="bg-dark">
	<div class="container">
		<nav class="navbar navbar-expand-xl" id="navbar">
			<a href="index.php" class="text-decoration-none mobile-logo">
				<span class="h2 text-uppercase text-primary bg-dark">Courier</span>
				<span class="h2 text-uppercase text-white px-2">Service</span>
			</a>
			<button class="navbar-toggler menu-btn" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      			<!-- <span class="navbar-toggler-icon icon-menu"></span> -->
				  <i class="navbar-toggler-icon fas fa-bars"></i>
    		</button>
    		<div class="collapse navbar-collapse" id="navbarSupportedContent">
      			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
        			<!-- <li class="nav-item">
          				<a class="nav-link active" aria-current="page" href="index.php" title="Products">Home</a>
        			</li> -->

					{{-- <li class="nav-item dropdown">
						<button class="btn btn-dark"  aria-expanded="false">
							Home
						</button> --}}
						
						
					</li>
					<li class="nav-item dropdown">
						<button class="btn btn-dark "  aria-expanded="false">
							<li><a class="" href="{{ route('front.about') }}">About Us</a></li>
						</button>
						
					</li>
					<li class="nav-item dropdown">
						<button class="btn btn-dark "  aria-expanded="false">
							<li><a class="" href="{{ route('front.contacts') }}">Contact Us</a></li>

						</button>
						
					</li>

					<ul class="navbar-nav ms-auto">
						@if(auth()->guest())

						@else
						<li class="nav-item dropdown">
							<button class="btn btn-dark " aria-expanded="false">
								<li><a class="" href="{{ route('account.login') }}">My Profile</a></li>
								
							</button>
							
						</li>
							
						
						@endif
					</ul>

					
					
					
      			</ul>      			
      		</div> 
			 
			 
		    
			  <ul class="navbar-nav ms-auto">
				@if(auth()->guest())
					<li class="nav-item">
						<a class="nav-link cartblack" id="loginblack" href="{{ route('account.login') }}">{{ __('Login') }}</a>
					</li>
					<li class="nav-item">
						<a class="nav-link cartblack" id="loginblack" href="{{ route('account.register') }}">{{ __('Register') }}</a>
					</li>
				
				@endif
			</ul>
			
			 
			
		

      	</nav>
  	</div>
</header>


<main>
   @yield('content')
</main>

<footer class="bg-dark mt-5">
	<div class="container pb-5 pt-3">
		<div class="row">
			<div class="col-md-4">
				<div class="footer-card">
					<h3>Get In Touch</h3>
					<p>No dolore ipsum accusam no lorem. <br>
					123 Street, New York, USA <br>
					exampl@example.com <br>
					000 000 0000</p>
				</div>
			</div>

			<div class="col-md-4">
				<div class="footer-card">
					<h3>Important Links</h3>
					<ul>
						<li><a href="about-us.php" title="About">About</a></li>
						<li><a href="contact-us.php" title="Contact Us">Contact Us</a></li>						
						<li><a href="#" title="Privacy">Privacy</a></li>
						<li><a href="#" title="Privacy">Terms & Conditions</a></li>
						<li><a href="#" title="Privacy">Refund Policy</a></li>
					</ul>
				</div>
			</div>

			<div class="col-md-4">
				<div class="footer-card">
					{{-- <h3>My Account</h3>
					
						<li><a href="{{route('account.login')}}" title="Sell">Login</a></li>
						<li><a href="{{route('account.register')}}" title="Advertise">Register</a></li>
					
					</ul> --}}
				</div>
			</div>			
		</div>
	</div>
	<div class="copyright-area">
		<div class="container">
			<div class="row">
				<div class="col-12 mt-3">
					<div class="copy-right text-center">
						<p>© Copyright 2024 Courier Management System. All Rights Reserved</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
<script src="{{asset('front-assets/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('front-assets/js/bootstrap.bundle.5.1.3.min.js')}}"></script>
<script src="{{asset('front-assets/s/instantpages.5.1.0.min.js')}}"></script>
<script src="{{asset('front-assets/js/lazyload.17.6.0.min.js')}}"></script>
<script src="{{asset('front-assets/js/slick.min.js')}}"></script>
<script src="{{asset('front-assets/js/custom.js')}}"></script>
<script>
window.onscroll = function() {myFunction()};

var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}
</script>
</body>





{{-- </html><nav class="navbar navbar-expand-lg navbar-default navbar-dark fixed-top">
    <div class="container-fluid navbar-default">
      <a class="navbar-brand" href="{{ url('/') }}">BLISS</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ms-auto">
          <a class="nav-link px-3 active" aria-current="page" href="/">Home</a>
          <a class="nav-link px-3" href="{{ url('category') }}">Categories</a>
          <a class="nav-link px-3" href="{{ url('contact') }}">Contact</a>
          <a class="nav-link px-3" href="{{ url('about') }}">About Us</a>
        </div>
        <div class="navbar-nav ms-auto justify-content-center">
          @if(session('user'))
            <div class="input-group hello">
              <form class="d-flex bg-transparent w-100" action="{{ url('searchProduct') }}" method="POST">
                @csrf
                <div class="input-group">
                  <input name="product_name" required type="search" id="search_product" class="form-control bg-dark rounded-pill outline-none shadow-none border-0" placeholder="Search..." aria-label="Search" aria-describedby="button-addon2">
                  <button class="btn" type="submit" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
              </form>
            </div>
            <a class="cartblack nav-link" href="{{ route('cart') }}"><i class="fa-solid fa-cart-shopping"></i></a>
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img (31).webp" class="rounded-circle" height="22" alt="User Avatar" loading="lazy" />
              </a>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <a class="dropdown-item">{{ App\Models\User::find(session('user'))->name }}</a>
                <a class="dropdown-item" href="{{ route('logout') }}">
                  {{ __('Logout') }}
                </a>
              </div>
            </li>
          @else
            <li class="nav-item">
              <a class="nav-link cartblack" id="loginblack" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link cartblack" id="loginblack" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
          @endif
        </div>
      </div>
    </div>
  </nav> --}}