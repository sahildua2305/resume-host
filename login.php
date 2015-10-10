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
						<div class="col-lg-4 col-lg-offset-4">
							<form role="form" action="" method="POST">
								<div class="form-group">
									<label>Username</label>
									<input type="text" class="form-control" name="username" placeholder="Enter your username" required>
								</div>
								<div class="form-group">
									<label for="password">Password</label>
									<input type="password" class="form-control" name="password" placeholder="Password" required>
								</div>
								<button type="submit" class="btn btn-default" name="login">Submit</button>
							</form>
						</div>
					</div>
					<hr>
					<div class="row">
						<h4>New User? <a href="register.php">Sign up</a></h4>
					</div>
				</div>
			</div>
		</section>
	</body>
</html>
<?php
	$connection = connect_server();
	if(isset($_POST['login'])) {
		$username = strip_tags($_POST['username']);
		$password = md5(strip_tags($_POST['password']));
		$query = "SELECT `username` FROM user_details WHERE username = '$username' AND password = '$password'";
		$result = mysqli_query($connection, $query);
		$num = mysqli_num_rows($result);
		if($num == 1) {
			$_SESSION['resume_email'] = $username;
			header('Location: upload.php');
		}
		else
			echo "Username/Password not matching!!";
	}
?>