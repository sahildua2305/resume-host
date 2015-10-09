<?php 
	
	include 'inc/header.php';
	require 'inc/functions.php';

	session_start();
	if(!isset($_SESSION['resume_email'])){
		header('Location: login.php');
	}
	else{
		$email = strip_tags($_SESSION['resume_email']);
	}
	
	$connection = connect_server();
	// $array = mysqli_query($connection, "select * from initial where username='$username'");
	// $row = mysqli_fetch_array($array);
	// $id = $row['id'];
	// $array1 = mysqli_query($connection, "SELECT * FROM profile WHERE id = '$id'");
	// $row1 = mysqli_fetch_array($array1);
?>
	<body>
		<section class="intro">
			<div class="intro-body">
				<div class="container text-center">
					<div class="row">
						<h1><a href="index.php">Pass.Me</a></h1>
						<h2>Edit your profile</h2>
					</div>
					<a href="profile.php?name=<?php echo $username; ?>" class="btn btn-lg btn-success">View profile</a>
					<a href="hide.php" class="btn btn-lg btn-danger">Hide items</a>
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
		
		
		if($firstname!=$row['firstname'] || $lastname!=$row['lastname'] || $emailid!=$row['emailid']){
			mysqli_query($connection, "UPDATE initial SET firstname='$firstname', lastname='$lastname', emailid='$emailid' WHERE id='$id'");
			header('Location: edit.php');
		}
		mysqli_query($connection, "UPDATE profile SET number='$number', college='$college', gradyear='$gradyear', branch='$branch', expComp1='$expComp1', expPos1='$expPos1', proName1='$proName1', proLink1='$proLink1' WHERE id='$id'");
		header('Location: edit.php');
		
	}
?>