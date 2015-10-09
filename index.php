<?php include 'inc/header.php';?>
<?php
	session_start();
?>
	<body id="page-top" data-spy="scroll" data-target=".navbar-custom">
		<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header page-scroll">
					<a class="navbar-brand" href="/index.php">
						<i class="fa fa-play-circle"></i>  <span class="light">Resume</span>-Host
					</a>
				</div
			</div>
		</nav>

		<section class="intro">
			<div class="intro-body">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<h1 class="brand-heading">Resume-host</h1>
							<p class="intro-text"> </p>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4"></div>
						<?php if(isset($_SESSION['username'])) : ?>
							<div class="col-lg-4">
								<a href="profile.php?name=<?php echo $_SESSION['username'];?>" class="btn btn-lg btn-success">View profile</a>
								<a href="logout.php" class="btn btn-lg btn-danger">Logout</a>
							</div>
						<?php else : ?>
							<div class="col-lg-4">
								<a href="register.php" class="btn btn-lg btn-success">Register</a>
								<a href="login.php" class="btn btn-lg btn-primary">Login</a>
							</div>
						<?php endif; ?>
						<div class="col-lg-4"></div>
					</div>
				</div>
			</div>
		</section>

		<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
		<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

		<script src="js/grayscale.js"></script>

	</body>
</html>