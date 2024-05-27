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
        		 <li class="nav-item">
          				<a class="nav-link active" aria-current="page" href="{{route('front.home')}}" title="Products">Home</a>
        			</li> 

					
						
						
					</li>
					<li class="nav-item dropdown">
						<button class="btn btn-dark "  aria-expanded="false">
							<li><a class="" href="{{ route('front.about') }}">About US</a></li>
						</button>
						
					</li>
					<li class="nav-item dropdown">
						<button class="btn btn-dark "  aria-expanded="false">
							<li><a class="" href="{{ route('front.contacts') }}">Contact US</a></li>

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
					<h3>Connect US</h3>
					<p>With our Courier service, We can make easy our daily life. <br>
						24/25 Dilkusha <br>
						Motijheel,Dhaka-1000<br>

					Email:courierservice@gmail.com <br>
					phone:09612003003<br>
				</p>
				</div>
			</div>

			<div class="col-md-4">
				<div class="footer-card">
					<h3>Useful  Links</h3>
					<ul>
						<li><a href="{{route('front.home')}}" title="Home">Home</a></li>
						<li><a href="{{route('front.about')}}" title="About">About US</a></li>
						<li><a href="{{route('front.contacts')}}" title="Contact Us">Contact US</a></li>						
						
					</ul>
				</div>
			</div>

			<div class="col-md-4">
				<div class="footer-card">

					<p>Our Courier Service (Pvt.) <br>Limited has been playing a leading role in <br>these service activities of courier and parcel <br>since its inception in 1983.<br> The Founder, Chairman Imamul Kabir Shanto,<br> has led the effective development and establishment <br>of courier service in Bangladesh.</p>
					
				</div>
			</div>			
		</div>
	</div>
	
	

	
	<div class="copyright-area">
		<div class="container">
			<div class="row">
				<div class="col-12 mt-3">
					<div class="copy-right text-center">
						<p> Courier Management System. All Rights Reserved</p>
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



