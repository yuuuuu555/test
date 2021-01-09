
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title>Login</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="Slide Login Form template Responsive, Login form web template, Flat Pricing tables, Flat Drop downs Sign up Web Templates, Flat Web Templates, Login sign up Responsive web template, SmartPhone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />

	 <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>

	<!-- Custom Theme files -->
	<link href="{{URL::asset('./static/login/css/style.css')}}" rel="stylesheet" type="text/css" media="all" />
	<link href="{{URL::asset('./static/login/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" media="all" />
	<!-- //Custom Theme files -->

	<!-- web font -->
	<link href="{{URL::asset('./static/login/fonts.googleapis.com/css?family=Hind:300,400,500,600,700')}}" rel="stylesheet">
	<!-- //web font -->

</head>
<body>

<!-- main -->
<div class="w3layouts-main"> 
	<div class="bg-layer">
		<h1>LOGIN</h1>
		<div class="header-main">
			<div class="main-icon">
				{{-- fa fa-eercast --}}
				<span class="">LOGIN</span>
			</div>
			<div class="header-left-bottom">
			{{--  --}}
				<form action="" method="POST">
					<div class="icon1">
						<span class="fa fa-user"></span>
						<input type="acount" placeholder="Acount" required="" name="Acount"/>
					</div>
					<div class="icon1">
						<span class="fa fa-lock"></span>
						<input type="password" placeholder="Password" required="" name="Password"/>
					</div>
					<div class="icon2">
						<span class=""></span>
						<input type="code" placeholder="code" required="" name="Code"/>
					
					</div>
					<img src="{{url('loginCode')}}" alt ="">
					{{-- <div class="login-check">
						 <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i> </i> Keep me logged in</label>
					</div> --}}
					<div class="bottom">
						<button class="btn" type="submit">Log In</button>
					</div>
					<div class="links">
						<p><a href="#">Forgot Password?</a></p>
						<p class="right"><a href="#">New User? Register</a></p>
						<div class="clear"></div>
					</div>
					<div></div>
				</form>	
			</div>
			{{-- <div class="social">
				<ul>
					<li>or login using : </li>
					<li><a href="#" class="facebook"><span class="fa fa-facebook"></span></a></li>
					<li><a href="#" class="twitter"><span class="fa fa-twitter"></span></a></li>
					<li><a href="#" class="google"><span class="fa fa-google-plus"></span></a></li>
				</ul>
			</div> --}}
		</div>
		
		<!-- copyright -->
		<div class="copyright">
			<p>© 2019 Slide Login Form . All rights reserved | Design by <a href="http://w3layouts.com/" target="_blank">W3layouts</a></p>
		</div>
		<!-- //copyright --> 
	</div>
</div>	
<!-- //main -->

</body>
</html>