<?php
	include 'inc/header.php'; 
	require 'inc/functions.php';
?>
<?php
	session_start();
	if(isset($_SESSION['resume_email'])){
		header('Location: upload.php');
	}
?>
	<body>
		<section class="intro">
			<div class="intro-body">
				<div class="container text-center">
					<div class="row">
						<h1><a href="index.php">Resume-host</a></h1>
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
								
								<div class="form-group">
									<div class="col-md-5">
										<img src="captcha.php"/>
									</div>
									<div class="col-md-7">
										<label>Enter the security code*</label>
										<input type="text" class="form-control" id="code" name="code" placeholder="dude you need to prove you are a human" required>
									</div>
								</div>
								<div class="clearfix"></div>
								<hr>
								<button type="submit" class="btn btn-default" name="register">Submit</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
	</body>
</html>
<?php
	$connection = connect_server();
	if (isset($_POST['register']))
	{
		$username 	= strip_tags($_POST['username']);
		$firstname 	= ucfirst(strip_tags($_POST['firstname']));
		$lastname 	= ucfirst(strip_tags($_POST['lastname']));
		$password 	= md5(strip_tags($_POST['password']));
		$cpassword 	= md5(strip_tags($_POST['cpassword']));
		
		if($password != $cpassword){
			$error_message = "Password not matching";
		} else if($_POST['code'] != $_SESSION['captcha']){
			$error_message = "Please check that you have entered the correct security code!";
		} else {
			$query = "INSERT INTO user_details(username,firstname,lastname,password) VALUES('$username', '$firstname','$lastname' ,'$password')";
			$query_run = mysqli_query($connection, $query);
			if($query_run){
				header('Location: login.php');
			} else{
				if(strpos(mysqli_error($connection), "Duplicate entry") !== false)
					$error_message = 'Seems like someone already took this username, try something else';
				else 
					$error_message = "Couldn't Register, Please Try Again!";
			}
		}
		header('Location: register.php?error=' . $error_message);
	}
?>