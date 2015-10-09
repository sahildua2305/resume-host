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
					<div class="row">
						<div class="col-lg-4"></div>
						<div class="col-lg-4">
							<form role="form" action="" method="POST">
								<div class="form-group">
									<label for="firstname">First Name*</label>
									<input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter First Name" required>
								</div>
								<div class="form-group">
									<label for="lastname">Last Name</label>
									<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter Last Name">
								</div>
								<div class="form-group">
									<label for="email">Email ID*</label>
									<input type="email" class="form-control" id="email" name="email" placeholder="Enter Email ID" required>
								</div>
								<div class="form-group">
									<label for="password">Password*</label>
									<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
								</div>
								<div class="form-group">
									<label for="cpassword">Confirm Password*</label>
									<input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password" required>
								</div>
								<div class="form-group">
									<img src="captcha.php"/>
									<input type="text" class="form-control" id="code" name="code" placeholder="Enter Security Code" required>
								</div>
								<button type="submit" class="btn btn-default" name="register">Submit</button>
							</form>
						</div>
						<div class="col-lg-4"></div>
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
		$email= strip_tags($_POST['email']);
		$firstname= ucfirst(strip_tags($_POST['firstname']));
		$lastname= ucfirst(strip_tags($_POST['lastname']));
		$password= md5(strip_tags($_POST['password']));
		$cpassword= md5(strip_tags($_POST['cpassword']));
		
		if($password != $cpassword)
			echo "Password not matching<br>";
		if($_POST['code'] != $_SESSION['captcha'])
			echo "Please check that you have entered the correct security code!<br>";
		
		if(mysqli_query($connection, "insert into user_details(email,firstname,lastname,password) values('$email', '$firstname','$lastname' ,'$password')")){
			header('Location: login.php');
		}
		else
			echo "Couldn't Register, Please Try Again!";
	}
?>