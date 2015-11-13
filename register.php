<?php
	require 'inc/functions.php';
	require 'lib/g-captcha/recaptchalib.php';

	ob_start();
	session_start();

	// your secret key
	$secret = "6LfOxxATAAAAAFHdmglB_w6CZqeMJ1KH82XrGxkH";
	// empty response
	$response = null;
	// check secret key
	$reCaptcha = new ReCaptcha($secret);

	if(isset($_SESSION['resume_email'])){
		header('Location: upload.php');
	}

	$connection = connect_server();

	if (isset($_POST['register'])){
		$reload_flag = true;

		$username 	= strip_tags($_POST['username']);
		$firstname 	= ucfirst(strip_tags($_POST['firstname']));
		$lastname 	= ucfirst(strip_tags($_POST['lastname']));
		$password 	= md5(strip_tags($_POST['password']));
		$cpassword 	= md5(strip_tags($_POST['cpassword']));
		$email 		= strtolower(strip_tags($_POST['email']));

		if($_POST["g-recaptcha-response"])
		    $response = $reCaptcha->verifyResponse($_SERVER["REMOTE_ADDR"],$_POST["g-recaptcha-response"]);
		
		if($password != $cpassword){
			$error_message = "Password not matching";
		} else if($response != null && $response->success) {
			$query = "INSERT INTO `user_details`(`username`, `firstname`, `lastname`, `password`, `email`) VALUES('$username', '$firstname','$lastname' ,'$password', '$email')";
			$query_run = mysqli_query($connection, $query);
			if($query_run){	
				$reload_flag = false;
			} else if(strpos(mysqli_error($connection), "Duplicate entry") !== false){
				$error_message = 'Seems like someone already took this username or you have already registered with this email address, try something else';
			} else {
				$error_message = "Couldn't Register, Please Try Again!";
			}
		} else {
			$error_message = "Sorry we only accept human resumes!";
		}

		if($reload_flag){
			header('Location: register.php?error=' . $error_message);	
		} else {
			header('Location: login.php');
		}
		
	}

	include 'inc/header.php'; 
?>
	<body>
		<?php include 'inc/nav.inc.php'; ?>
		<section class="intro">
			<div class="intro-body">
				<div class="container text-center">
					<div class="row">
						<!-- <h1><a href="index.php">Resume-host</a></h1> -->
						<h2>Register</h2>
					</div>
<?php 
	if(isset($_GET['error'])){
		echo '
				<div class="alert alert-danger alert-dismissible fade in" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' . $_GET['error'] . '
				</div>';
		
	}
?>
					<div class="row">
						<div class="col-md-6 col-md-offset-3">
							<form role="form" action="" method="POST">
								<div class="form-group">
									<div class="col-md-6">
										<label>First Name*</label>
										<input type="text" class="form-control" name="firstname" placeholder="So that we could know you" required>
									</div>
									<div class="col-md-6">
										<label>Last Name</label>
										<input type="text" class="form-control" name="lastname" placeholder="only if you have one">
									</div>
								</div>
								<div class="clearfix"></div>
								<br>
								<div class="form-group">
									<label>Username*</label>
									<input type="text" class="form-control" name="username" placeholder="Now this is something important" required>
								</div>
								<div class="form-group">
									<label>Email ID*</label>
									<input type="email" class="form-control" name="email" placeholder="Even we don't like to spam" required>
								</div>
								<div class="form-group">
									<div class="col-md-6">
										<label for="password">Password*</label>
										<input type="password" class="form-control" name="password" placeholder="Password" required>
									</div>
									<div class="col-md-6">
										<label>Confirm Password*</label>
										<input type="password" class="form-control" name="cpassword" placeholder="Confirm Password" required>
									</div>
								</div>
								<div class="clearfix"></div>
								<hr>

								<center>
									<div class="g-recaptcha" data-sitekey="6LfOxxATAAAAAC6malEAp6sx50gK4ICC5rW-4QKw"></div>
								</center>
								
								<div class="clearfix"></div>
								<hr>
								<button type="submit" class="btn btn-default" name="register">Submit</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
<?php
	include 'inc/footer.inc.php';
?>
