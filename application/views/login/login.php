<!-- Login custom, not using default template -->
<!-- rename login default to login.php to use default login page -->

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <title>WMU Storage| Log in</title>
	  <!-- Tell the browser to be responsive to screen width -->
	  <meta name="viewport" content="width=device-width, initial-scale=1">

	  <!-- Font Awesome -->
	  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/fontawesome-free/css/all.min.css">
	  <!-- Ionicons -->
	  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	  <!-- Theme style -->
	  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/login/login_custom.css">
	  <!-- Google Font: Source Sans Pro -->
	  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	
</head>
<body class="hold-transition login-page" data-page-base="<?php echo base_url();?>">

	<div class="login-wrap">
		<div class="login-html">
			<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
			<input id="tab-2" type="radio" name="tab" class="sign-up" style="display: none;"><label for="tab-2" class="tab" style="display:none;">Sign Up</label>
				<div class="login-form">
			<form id="login-form" class="form-horizontal"  role="form">
					<div class="sign-in-htm">
						<div class="group" style="margin-top:20px;">
							<label for="user" class="label">Username</label>
							<input id="user" type="text" class="input" name="lg_username_" autofocus>
						</div>
						<div class="group">
							<label for="pass" class="label">Password</label>
							<input id="pass" type="password" class="input" data-type="password" name="lg_password_">
						</div>
						<div class="group" style="display:none;">
							<input id="check" type="checkbox" class="check" checked>
							<label for="check"><span class="icon"></span> Keep me Signed in</label>
						</div>
						<div class="group" style="margin-top:50px;margin-bottom:5px;">
							<button type="submit" class="button">Sign In</button>
						</div>
						<div class="hr"></div>
						<div class="foot-lnk" style="display:none;">
							<a href="#forgot">Forgot Password?</a>
						</div>
					</div>
					
			</form>
				</div>
		</div>
	</div>
</body>
<!-- jQuery -->
<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.min.js"></script>
<!-- JQuery Validation -->
<script src="<?php echo base_url();?>assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<!-- Custom Script -->
<script src="<?php echo base_url();?>assets/js/login/login.min.js"></script>
</html>