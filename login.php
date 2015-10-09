<?php include 'inc/header.php';?>
<?php
	session_start();
	if(isset($_SESSION['username'])){
		header('Location: edit.php');
	}
?>
	<body>
		<section class="intro">
			<div class="intro-body">
				<div class="container text-center">
					<div class="row">
						<h1><a href="index.php">Pass.Me</a></h1>
						<h2>Login</h2>
					</div>
					<div class="row">
						<div class="col-lg-4"></div>
						<div class="col-lg-4">
							<form role="form" action="" method="POST">
								<div class="form-group">
									<label for="username">Username</label>
									<input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
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
	$connection = mysqli_connect("69.65.10.232","mkstin_resume","+o{6Q,sJUgW^","mkstin_resume_host");
	if(isset($_POST['login'])) {
		$username= strip_tags($_POST['username']);
		$password= md5(strip_tags($_POST['password']));
		$query="select * from initial WHERE username='$username' and password='$password'";
		$result=mysqli_query($connection, $query);
		$num=mysqli_num_rows($result);
		if($num==1) {
			$_SESSION['username']=$_POST['username'];
			header('Location: edit.php');
		}
		else
			echo "Username/Password not matching!!";
	}
?>