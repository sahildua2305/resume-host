<?php include 'inc/header.php';
	session_start();
	if(!isset($_SESSION['username'])){
		header('Location: login.php');
	}
	else{
		$username = $_SESSION['username'];
	}
	
	$connection= mysqli_connect("69.65.10.232","mkstin_resume","+o{6Q,sJUgW^","mkstin_resume_host");
	$array=mysqli_query($connection, "select * from initial where username='$username'");
	$row = mysqli_fetch_array($array);
	$id = $row['id'];
	$array1 = mysqli_query($connection, "SELECT * FROM profile WHERE id = '$id'");
	$row1 = mysqli_fetch_array($array1);
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
							<form role="form" action="" method="POST">
								<div class="form-group">
									<label for="firstname">First Name</label>
									<input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter First Name" required value="<?php echo $row['firstname'];?>">
								</div>
								<div class="form-group">
									<label for="lastname">Last Name</label>
									<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter Last Name" required value="<?php echo $row['lastname'];?>">
								</div>
								<div class="form-group">
									<label for="email">Email ID</label>
									<input type="email" class="form-control" id="emailid" name="emailid" placeholder="Enter Email ID" required value="<?php echo $row['emailid'];?>">
								</div>
								<div class="form-group">
									<label for="number">Contact Number</label>
									<input type="text" class="form-control" id="number" name="number" placeholder="Enter Contact Number" value="<?php if($row1['number']!='') echo $row1['number']; ?>">
								</div>
								<div class="form-group">
									<label for="college">College</label>
									<input type="text" class="form-control" id="college" name="college" placeholder="Enter College Name" value="<?php if($row1['college']!='') echo $row1['college']; ?>">
								</div>
								<div class="form-group">
									<label for="gradyear">Graduation Year</label>
									<input type="text" class="form-control" id="gradyear" name="gradyear" placeholder="Enter Graduation Year" value="<?php if($row1['gradyear']!=0) echo $row1['gradyear']; ?>">
								</div>
								<div class="form-group">
									<label for="branch">Branch</label>
									<input type="text" class="form-control" id="branch" name="branch" placeholder="Enter your branch" value="<?php if($row1['branch']!='') echo $row1['branch']; ?>">
								</div>
								<div class="form-group">
									<label for="expComp1">Experience - Company</label>
									<input type="text" class="form-control" id="expComp1" name="expComp1" placeholder="Enter name of company" value="<?php if($row1['expComp1']!='') echo $row1['expComp1']; ?>">
								</div>
								<div class="form-group">
									<label for="expPos1">Your Position</label>
									<input type="text" class="form-control" id="expPos1" name="expPos1" placeholder="Enter your position" value="<?php if($row1['expPos1']!='') echo $row1['expPos1']; ?>">
								</div>
								<div class="form-group">
									<label for="proName1">Project Name 1</label>
									<input type="text" class="form-control" id="proName1" name="proName1" placeholder="Enter 1st Project Name" value="<?php if($row1['proName1']!='') echo $row1['proName1']; ?>">
								</div>
								<div class="form-group">
									<label for="proLink1">Project Link 1</label>
									<input type="text" class="form-control" id="proLink1" name="proLink1" placeholder="Enter 1st Project Link" value="<?php if($row1['proLink1']!='') echo $row1['proLink1']; ?>">
								</div>
								<button type="submit" class="btn btn-primary" name="save">Save Changes</button>
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
	if(isset($_POST['save'])){
		$firstname = strip_tags($_POST['firstname']);
		$lastname = strip_tags($_POST['lastname']);
		$emailid = strip_tags($_POST['emailid']);
		$number = strip_tags($_POST['number']);
		$college = strip_tags($_POST['college']);
		$gradyear = strip_tags($_POST['gradyear']);
		$branch = strip_tags($_POST['branch']);
		$expComp1 = strip_tags($_POST['expComp1']);
		$expPos1 = strip_tags($_POST['expPos1']);
		$proName1 = strip_tags($_POST['proName1']);
		$proLink1 = strip_tags($_POST['proLink1']);
		
		if($firstname!=$row['firstname'] || $lastname!=$row['lastname'] || $emailid!=$row['emailid']){
			mysqli_query($connection, "UPDATE initial SET firstname='$firstname', lastname='$lastname', emailid='$emailid' WHERE id='$id'");
			header('Location: edit.php');
		}
		mysqli_query($connection, "UPDATE profile SET number='$number', college='$college', gradyear='$gradyear', branch='$branch', expComp1='$expComp1', expPos1='$expPos1', proName1='$proName1', proLink1='$proLink1' WHERE id='$id'");
		header('Location: edit.php');
		
	}
?>