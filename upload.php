<?php 
	
	include 'inc/header.php';
	require 'inc/functions.php';

	session_start();
	if(!isset($_SESSION['resume_email'])){
		header('Location: login.php');
	}
	else{
		$resume_email = strip_tags($_SESSION['resume_email']);
	}
	
	$connection = connect_server();
	$id_result = mysqli_query($connection, "SELECT id FROM user_details WHERE email = '$resume_email'");
	// get user id from db
	print_r($id_result);
?>
	<body>
		<section class="intro">
			<div class="intro-body">
				<div class="container text-center">
					<div class="row">
						<h1><a href="index.php">Resume-host</a></h1>
						<h2>Upload your resume</h2>
					</div>
					<div class="row">
						<div class="col-lg-4"></div>
						<div class="col-lg-4">


						</div>
						<div class="col-lg-4"></div>
					</div>
				</div>
			</div>
		</section>
	</body>
</html>
<?php
	if(isset($_POST['save'])){

		$temp = explode(".",$_FILES["file"]["name"]);
		$extension = end($temp);
		$extension = strtolower($extension);
		$fileAccepted = checkFileExtensionForImage($extension);
		if($_FILES["file"]["error"] > 0)
		{
			echo "ERROR: ". $_FILES["file"]["error"]."<br>";
			echo '<a href="upload.php"><span style="color:#eb4141;">Try Again</span></a>';
		}
		elseif($fileAccepted == 1 && $_FILES["file"]["size"]<(5*1024*1024))
		{
			$newFileName = $_SESSION["resume_email"]."_".$_FILES["file"]["name"];

			if(file_exists("uploaded-resumes/". $newFileName))
			{
				echo $newFileName. " already exists.<br>";
				echo '<a href="upload.php"><span style="color:#eb4141;">Try Again</span></a>';
			}
			else
			{
				move_uploaded_file($_FILES["file"]["tmp_name"], "uploaded-resumes/".$newFileName);

				$insert = "";
				if(mysqli_query($con, $insert))
					echo "<br>Your resume has been uploaded";
				else echo "<br>Resume couldn't be saved. Please try again!";
			}
		}
		else die("Invalid File Type! Only PDFs(.pdf) are allowed");
		
	}
?>