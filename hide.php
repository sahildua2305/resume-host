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
	$array2 = mysqli_query($connection, "SELECT * FROM hidden WHERE id = '$id'");
	$row2 = mysqli_fetch_array($array2);
?>
	<body>
		<section class="intro">
			<div class="intro-body">
				<div class="container text-center">
					<div class="row">
						<h1><a href="index.php">Pass.Me</a></h1>
						<h2>Hide items from your profile</h2>
					</div>
					<a href="profile.php?name=<?php echo $username; ?>" class="btn btn-lg btn-success">View profile</a>
					<a href="edit.php" class="btn btn-lg btn-danger">Edit profile</a>
					<div class="row">
						<div class="col-lg-4"></div>
						<div class="col-lg-4">
							<form role="form" action="" method="POST">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="emailid" <?php if($row2['emailid']==1) echo "checked";?>>Hide email address
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="checkbox" name="number" <?php if($row2['number']==1) echo "checked";?>>Hide contact number
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="checkbox" name="college" <?php if($row2['college']==1) echo "checked";?>>Hide college name
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="checkbox" name="gradyear" <?php if($row2['gradyear']==1) echo "checked";?>>Hide graduation year
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="checkbox" name="branch" <?php if($row2['branch']==1) echo "checked";?>>Hide branch
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="checkbox" name="expComp1" <?php if($row2['expComp1']==1) echo "checked";?>>Hide Experience - Company 1
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="checkbox" name="expPos1" <?php if($row2['expPos1']==1) echo "checked";?>>Hide Experience - Position 1
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="checkbox" name="proName1" <?php if($row2['proName1']==1) echo "checked";?>>Hide Project Name 1
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="checkbox" name="proLink1" <?php if($row2['proLink1']==1) echo "checked";?>>Hide Project link 1
									</label>
								</div>
								<div class="form-group">
									<label for="passkey">Pass Key</label>
									<input type="text" class="form-control" id="passkey" name="passkey" placeholder="Enter secret pass key" value="<?php if($row['passkey']!='') echo $row['passkey']; ?>" required>
								</div>
								<button type="submit" class="btn btn-primary" name="hide">Save Changes</button>
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
	if(isset($_POST['hide'])){
		$emailid = (isset($_POST['emailid'])) ? 1 : 0;
		$number = (isset($_POST['number'])) ? 1 : 0;
		$college = (isset($_POST['college'])) ? 1 : 0;
		$branch = (isset($_POST['branch'])) ? 1 : 0;
		$gradyear = (isset($_POST['gradyear'])) ? 1 : 0;
		$expComp1 = (isset($_POST['expComp1'])) ? 1 : 0;
		$expPos1 = (isset($_POST['expPos1'])) ? 1 : 0;
		$proName1 = (isset($_POST['proName1'])) ? 1 : 0;
		$proLink1 = (isset($_POST['proLink1'])) ? 1 : 0;
		$passkey = strip_tags($_POST['passkey']);
		
		if($passkey != $row['passkey']){
			mysqli_query($connection, "UPDATE initial SET passkey='$passkey' WHERE id='$id'");
		}
		
		mysqli_query($connection, "UPDATE hidden SET emailid='$emailid', number='$number', college='$college', gradyear='$gradyear', branch='$branch', expComp1='$expComp1', expPos1='$expPos1', proName1='$proName1', proLink1='$proLink1' WHERE id='$id'");
		header('Location: hide.php');
	}
?>