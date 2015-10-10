<?php include 'inc/header.php';?>
<?php
	session_start();
?>
<body id="page-top" data-spy="scroll" data-target=".navbar-custom">
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header page-scroll">
				<a class="navbar-brand" href="index.php">
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
					<div class="col-md-8 col-md-offset-2">
						<?php if(isset($_SESSION['resume_email'])) : ?>
							<a href="uploaded-resumes/<?php echo $_SESSION['resume_email'];?>.pdf" class="btn btn-lg btn-success" target="_blank">View resume</a>
							<a href="upload.php" class="btn btn-lg btn-success">Upload resume</a>
							<a href="logout.php" class="btn btn-lg btn-danger">Logout</a>
						<?php else : ?>
							<a href="register.php" class="btn btn-lg btn-success">Register</a>
							<a href="login.php" class="btn btn-lg btn-primary">Login</a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php
	include 'inc/footer.inc.php';
?>