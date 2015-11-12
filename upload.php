<?php
	ob_start();
	session_start();

	if(!isset($_SESSION['resume_email'])){
		header('Location: login.php');
	}

	require 'inc/functions.php';

	$panel_colors = ['danger', 'success'];

	if(isset($_POST['save'])){

		$temp = explode(".",$_FILES["file"]["name"]);
		$extension = end($temp);
		$extension = strtolower($extension);
		$fileAccepted = checkFileExtensionForImage($extension);

		if($_FILES["file"]["error"] > 0){
			$success = 0;
			$message = "ERROR: ". $_FILES["file"]["error"];
			// echo '<a href="upload.php"><span style="color:#eb4141;">Try Again</span></a>';
		
		} elseif($fileAccepted == 1 && $_FILES["file"]["size"]<(5*1024*1024)) {
			
			$newFileName = $_SESSION["resume_email"] . '.' . $extension;
			move_uploaded_file($_FILES["file"]["tmp_name"], "uploaded-resumes/".$newFileName);
			$success = 1;
			$message = "Your resume has been uploaded";

		} else {
			$success = 0;
			$message = "Invalid File Type! Only PDFs(.pdf) are allowed";
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
<?php
	if(file_exists("uploaded-resumes/". $_SESSION['resume_email'] . '.pdf')){
		echo '<h2>You already have one resume uploaded<br><a href="/' . $_SESSION['resume_email'] . '" target="_blank">View your resume</a><br><br>or<br><br>';
	} else {
		echo '<h2>';
	}
?>
						Upload a new resume</h2>
					</div>
<?php	
	if(isset($success))	{
		echo '
		<div class="alert alert-' . $panel_colors[$success] . ' alert-dismissible fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' . $message . '</div>';
	}
	
	if(@$success != 1) {
?>
					<div class="col-md-4 col-md-offset-4">
						<form method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<input type="file" name="file" id="exampleInputFile">
							</div>
							<button type="submit" name="save" class="btn btn-default btn-lg">Submit</button>
						</form>
					</div>
<?php
	}
?>
				</div>
			</div>
		</section>
<?php
	include 'inc/footer.inc.php';
?>