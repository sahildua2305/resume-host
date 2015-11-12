<?php
	ob_start();
	session_start();
	
	include 'inc/header.php';
?>
<body id="page-top" data-spy="scroll" data-target=".navbar-custom">

<?php include 'inc/nav.inc.php'; ?>

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
<?php
	if(isset($_SESSION['resume_email'])){
		if(file_exists("uploaded-resumes/". $_SESSION['resume_email'] . '.pdf')){
			echo '<a href="/' . $_SESSION['resume_email']. '" class="btn btn-lg btn-success" target="_blank">View resume</a>';
		}
?>
							<a href="upload.php" class="btn btn-lg btn-success">Upload resume</a>
							<a href="logout.php" class="btn btn-lg btn-danger">Logout</a>
<?php
	} else {
?>
							<a href="register.php" class="btn btn-lg btn-success">Register</a>
							<a href="login.php" class="btn btn-lg btn-primary">Login</a>
<?php
	}
?>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php
	include 'inc/footer.inc.php';
?>