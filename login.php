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
						<h2>Login</h2>
					</div>
					<div class="row">
						<div class="col-lg-4"></div>
						<div class="col-lg-4">
							<form role="form" action="" method="POST">
								<div class="form-group">
									<label for="email">Email ID</label>
									<input type="email" class="form-control" id="email" name="email" placeholder="Enter Email ID">
								</div>
								<div class="form-group">
									<label for="password">Password</label>
									<input type="password" class="form-control" id="password" name="password" placeholder="Password">
								</div>
								<button type="submit" class="btn btn-default" name="login">Submit</button>
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
	if(isset($_POST['login'])) {
		$email = strip_tags($_POST['email']);
		$password = md5(strip_tags($_POST['password']));
		$query = "select email from user_details WHERE email = '$email' and password = '$password'";
		$result = mysqli_query($connection, $query);
		$num = mysqli_num_rows($result);
		if($num==1) {
			$_SESSION['resume_email'] = $email;
			header('Location: upload.php');
		}
		else
			echo "Username/Password not matching!!";
	}
?>